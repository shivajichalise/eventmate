import { useState, useRef } from "react";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import SelectInput from "@/Components/SelectInput";
import { Link, useForm, usePage } from "@inertiajs/react";
import { Transition } from "@headlessui/react";

export default function UpdateProfileInformation({
    mustVerifyEmail,
    status,
    className = "",
}) {
    const user = usePage().props.auth.user;

    const { data, setData, patch, errors, processing, recentlySuccessful } =
        useForm({
            name: user.name,
            email: user.email,
            gender: user.gender,
            is_disabled: user.is_disabled,
        });

    const submit = (e) => {
        e.preventDefault();
        patch(route("profile.update"), { preserveScroll: true });
    };

    const genderOptions = [
        { label: "Male", value: "Male" },
        { label: "Female", value: "Female" },
        { label: "Other", value: "Other" },
    ];

    const isDisabledOptions = [
        { label: "No", value: 0 },
        { label: "Yes", value: 1 },
    ];

    const [dob, setDob] = useState(new Date());
    // const selectedGenderOption, setSelectedGenderOption] = useState(
    //     genderOptions[0].value
    // );
    //
    // const handleGenderOptionChange = (e) => {
    //     setSelectedGenderOption(e.target.value);
    // };
    //
    // const [isDisabled, setIsDisabled] = useState(isDisabledOptions[0].value);
    //
    // const handleisDisabledOptionChange = (e) => {
    //     setIsDisabled(e.target.value);
    // };

    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Profile Information
                </h2>

                <p className="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Update your account's profile information and email address.
                </p>
            </header>

            <form onSubmit={submit} className="mt-6 space-y-6">
                <div>
                    <InputLabel htmlFor="name" value="Name" />

                    <TextInput
                        id="name"
                        className="mt-1 block w-full"
                        value={data.name}
                        onChange={(e) => setData("name", e.target.value)}
                        required
                        isFocused
                        autoComplete="name"
                    />

                    <InputError className="mt-2" message={errors.name} />
                </div>

                <div>
                    <InputLabel htmlFor="email" value="Email" />

                    <TextInput
                        id="email"
                        type="email"
                        className="mt-1 block w-full"
                        value={data.email}
                        onChange={(e) => setData("email", e.target.value)}
                        required
                        autoComplete="username"
                    />

                    <InputError className="mt-2" message={errors.email} />
                </div>

                {mustVerifyEmail && user.email_verified_at === null && (
                    <div>
                        <p className="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            Your email address is unverified.
                            <Link
                                href={route("verification.send")}
                                method="post"
                                as="button"
                                className="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                            >
                                Click here to re-send the verification email.
                            </Link>
                        </p>

                        {status === "verification-link-sent" && (
                            <div className="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                A new verification link has been sent to your
                                email address.
                            </div>
                        )}
                    </div>
                )}

                <div>
                    <InputLabel htmlFor="gender" value="Gender" />

                    <SelectInput
                        id="gender"
                        className="mt-1 block w-full"
                        value={data.gender}
                        onChange={(e) => setData("gender", e.target.value)}
                        required
                        options={genderOptions}
                    />

                    <InputError className="mt-2" message={errors.gender} />
                </div>

                <div>
                    <InputLabel
                        htmlFor="isDisabled"
                        value="Are you disabled?"
                    />

                    <SelectInput
                        id="is_disabled"
                        className="mt-1 block w-full"
                        value={data.is_disabled}
                        onChange={(e) => setData("is_disabled", e.target.value)}
                        required
                        options={isDisabledOptions}
                    />

                    <InputError className="mt-2" message={errors.isDisabled} />
                </div>

                <div className="flex items-center gap-4">
                    <PrimaryButton disabled={processing}>Save</PrimaryButton>

                    <Transition
                        show={recentlySuccessful}
                        enterFrom="opacity-0"
                        leaveTo="opacity-0"
                        className="transition ease-in-out"
                    >
                        <p className="text-sm text-gray-600 dark:text-gray-400">
                            Saved.
                        </p>
                    </Transition>
                </div>
            </form>
        </section>
    );
}
