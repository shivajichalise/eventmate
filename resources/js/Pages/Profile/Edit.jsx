import { useState } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import DeleteUserForm from "./Partials/DeleteUserForm";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm";
import Stepper from "@/Components/Stepper";
import { Head } from "@inertiajs/react";

export default function Edit({ auth, mustVerifyEmail, status }) {
    const steps = [
        {
            title: "Personal Info",
            form: (
                <UpdateProfileInformationForm
                    mustVerifyEmail={mustVerifyEmail}
                    status={status}
                    className="max-w-full"
                />
            ),
        },
        { title: "Address Info", form: "Add" },
        { title: "Contact Info", form: "Cont" },
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

                    <div className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <UpdatePasswordForm className="max-w-xl" />
                    </div>

                    <div className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <DeleteUserForm className="max-w-xl" />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
