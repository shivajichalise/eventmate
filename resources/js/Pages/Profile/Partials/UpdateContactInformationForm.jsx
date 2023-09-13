import { useState } from "react";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import { Link, useForm, usePage } from "@inertiajs/react";
import { Transition } from "@headlessui/react";

export default function UpdateContactInformation({
    mustVerifyEmail,
    status,
    className = "",
}) {
    const user = usePage().props.auth.user;

    const { data, setData, patch, errors, processing, recentlySuccessful } =
        useForm({
            mobile_number: user.mobile_number,
            emergency_number: user.emergency_number,
        });

    const submit = (e) => {
        e.preventDefault();
        patch(route("profile.update.contact"), { preserveScroll: true });
    };

    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Contact Information
                </h2>

                <p className="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Update your account's contact information.
                </p>
            </header>

            <form onSubmit={submit} className="mt-6 space-y-6">
                <div>
                    <InputLabel htmlFor="mobile_number" value="Mobile Number" />

                    <TextInput
                        id="mobile_number"
                        className="mt-1 block w-full"
                        value={data.mobile_number}
                        onChange={(e) =>
                            setData("mobile_number", e.target.value)
                        }
                        required
                        isFocused
                        autoComplete="mobile_number"
                    />

                    <InputError
                        className="mt-2"
                        message={errors.mobile_number}
                    />
                </div>

                <div>
                    <InputLabel
                        htmlFor="emergency_number"
                        value="Emergency number"
                    />

                    <TextInput
                        id="emergency_number"
                        className="mt-1 block w-full"
                        value={data.emergency_number}
                        onChange={(e) =>
                            setData("emergency_number", e.target.value)
                        }
                        required
                        autoComplete="emergency_number"
                    />

                    <InputError
                        className="mt-2"
                        message={errors.emergency_number}
                    />
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
