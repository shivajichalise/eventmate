import { useState } from "react";

export default function Feature({ title, description, icon }) {
    const [showDescription, setShowDescription] = useState(false);

    const handleToggle = () => {
        setShowDescription(!showDescription);
    };

    return (
        <div className="flex gap-4 w-full items-center">
            <div
                className="bg-primary rounded-lg p-2 h-fit cursor-pointer"
                onClick={handleToggle}
            >
                {icon}
            </div>

            <div className="flex flex-col justify-between">
                <div onClick={handleToggle} className="cursor-pointer">
                    <h1 className="font-semibold text-lg lg:text-xl">
                        {title}
                    </h1>
                </div>
                <div className={showDescription ? `block` : `hidden`}>
                    <p className="text-md lg:text-lg">{description}</p>
                </div>
            </div>
        </div>
    );
}
