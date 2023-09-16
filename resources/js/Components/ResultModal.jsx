import React from "react";
import PopupModal from "@/Components/PopupModal";

function ResultModal({ id, title, description, downloadLink }) {
    return (
        <>
            <label htmlFor={id} className="text-sm">
                View result
            </label>

            <PopupModal
                id={id}
                title={title}
                description={description}
                downloadLink={`/results/download`.id}
            />
        </>
    );
}

export default ResultModal;
