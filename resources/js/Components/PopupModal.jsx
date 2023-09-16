import React from "react";

function PopupModal({ id, title, description, hasFile }) {
    return (
        <>
            <input type="checkbox" id={id} className="modal-toggle" />
            <div className="modal">
                <div className="modal-box">
                    <h3 className="text-lg font-bold">{title}</h3>
                    <p className="py-4">{description}</p>

                    {hasFile && (
                        <a href={`/results/download/` + id} className="btn">
                            Download
                        </a>
                    )}
                </div>
                <label className="modal-backdrop" htmlFor={id}>
                    Close
                </label>
            </div>
        </>
    );
}

export default PopupModal;
