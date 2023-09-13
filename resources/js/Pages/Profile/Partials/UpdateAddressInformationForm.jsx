import { useState } from "react";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import SelectInput from "@/Components/SelectInput";
import { Link, useForm, usePage } from "@inertiajs/react";
import { Transition } from "@headlessui/react";

export default function UpdateAddressInformation({
    mustVerifyEmail,
    status,
    className = "",
}) {
    const user = usePage().props.auth.user;

    const { data, setData, patch, errors, processing, recentlySuccessful } =
        useForm({
            address_line_1: user.address_line_1,
            state: user.state,
            city: user.city,
            country: user.country,
        });

    const submit = (e) => {
        e.preventDefault();
        patch(route("profile.update.address"), { preserveScroll: true });
    };

    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Address Information
                </h2>

                <p className="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Update your account's address information.
                </p>
            </header>

            <form onSubmit={submit} className="mt-6 space-y-6">
                <div>
                    <InputLabel
                        htmlFor="address_line_1"
                        value="Address Line 1"
                    />

                    <TextInput
                        id="address"
                        className="mt-1 block w-full"
                        value={data.address_line_1}
                        onChange={(e) =>
                            setData("address_line_1", e.target.value)
                        }
                        required
                        isFocused
                        autoComplete="address_line_1"
                    />

                    <InputError
                        className="mt-2"
                        message={errors.address_line_1}
                    />
                </div>

                <div>
                    <InputLabel htmlFor="state" value="State" />

                    <TextInput
                        id="state"
                        className="mt-1 block w-full"
                        value={data.state}
                        onChange={(e) => setData("state", e.target.value)}
                        required
                        autoComplete="state"
                    />

                    <InputError className="mt-2" message={errors.state} />
                </div>

                <div>
                    <InputLabel htmlFor="city" value="City" />

                    <TextInput
                        id="city"
                        className="mt-1 block w-full"
                        value={data.city}
                        onChange={(e) => setData("city", e.target.value)}
                        required
                        autoComplete="city"
                    />

                    <InputError className="mt-2" message={errors.city} />
                </div>

                <div>
                    <InputLabel htmlFor="country" value="Country" />

                    <TextInput
                        id="country"
                        className="mt-1 block w-full"
                        value={data.country}
                        onChange={(e) => setData("country", e.target.value)}
                        required
                        autoComplete="country"
                    />

                    <InputError className="mt-2" message={errors.country} />
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
