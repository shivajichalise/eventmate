import { useState } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import DeleteUserForm from "./Partials/DeleteUserForm";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm";
import UpdateAddressInformationForm from "./Partials/UpdateAddressInformationForm";
import UpdateContactInformationForm from "./Partials/UpdateContactInformationForm";
import Stepper from "@/Components/Stepper";
import { Head, usePage } from "@inertiajs/react";
import FlashMessage from "@/Components/FlashMessage";

export default function Edit({ auth, mustVerifyEmail, status, message }) {
    const { flash } = usePage().props;

    const steps = [
        {
            title: "Personal Info",
            form: (
                <UpdateProfileInformationForm
                    mustVerifyEmail={mustVerifyEmail}
                    status={status}
                    className="w-9/12"
                />
            ),
        },
        {
            title: "Address Info",
            form: (
                <UpdateAddressInformationForm
                    mustVerifyEmail={mustVerifyEmail}
                    status={status}
                    className="w-9/12"
                />
            ),
        },
        {
            title: "Contact Info",
            form: (
                <UpdateContactInformationForm
                    mustVerifyEmail={mustVerifyEmail}
                    status={status}
                    className="w-9/12"
                />
            ),
        },
    ];

    const totalSteps = steps.length;
    const [step, setStep] = useState(1);

    const onNext = () => {
        if (step < totalSteps) {
            setStep(step + 1);
        }
    };

    const onPrev = () => {
        if (step > 1) {
            setStep(step - 1);
        }
    };

    const formDisplay = () => {
        if (step >= 1 && step <= steps.length) {
            return steps[step - 1]; // Adjust for 0-based array index
        }
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Profile
                </h2>
            }
        >
            <Head title="Profile" />

            <div className="py-12">
                {flash.message && (
                    <FlashMessage
                        message={flash.message.message}
                        type={flash.message.type}
                    />
                )}

                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <Stepper
                            steps={steps}
                            totalSteps={totalSteps}
                            step={step}
                            form={formDisplay()}
                            onNext={onNext}
                            onPrev={onPrev}
                        />
                    </div>

                    <div className="flex justify-center p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <UpdatePasswordForm className="w-9/12" />
                    </div>

                    <div className="flex justify-center p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <DeleteUserForm className="w-9/12" />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
