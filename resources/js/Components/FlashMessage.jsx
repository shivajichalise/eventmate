import React, { useState, useEffect } from "react";

const FlashMessage = ({ message, type, onClose }) => {
    const [showMessage, setShowMessage] = useState(true);

    useEffect(() => {
        const timer = setTimeout(() => {
            setShowMessage(false);
            if (onClose) {
                onClose();
            }
        }, 3000); // Adjust the timeout as needed (e.g., 3000 milliseconds = 3 seconds)

        return () => {
            clearTimeout(timer);
        };
    }, [onClose]);

    if (!showMessage) {
        return null;
    }

    const alertClasses = {
        success: "bg-success border-success text-primary-100",
        error: "bg-error border-error text-primary-100",
        info: "bg-warning border-warning text-primary-100",
    };

    return (
        <div
            className={`max-w-7xl mx-auto sm:px-6 lg:px-8 rounded-md p-4 border-l-4 ${alertClasses[type]} border-r-4`}
        >
            <div className="flex">
                <div className="py-1">
                    {type === "success" && (
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            className="h-6 w-6 text-green-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                strokeWidth="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                    )}
                    {type === "error" && (
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            className="h-6 w-6 text-red-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                strokeWidth="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    )}
                    {type === "info" && (
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            className="h-6 w-6 text-blue-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                strokeWidth="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                            />
                        </svg>
                    )}
                </div>
                <div className="ml-3">
                    <p className="text-sm font-medium">{message}</p>
                </div>
            </div>
        </div>
    );
};

export default FlashMessage;
