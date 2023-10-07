function Stepper({ steps, totalSteps, step, form, onNext, onPrev }) {
    return (
        <div className="max-w-full mx-auto mt-8">
            <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <ul className="steps w-full mb-3">
                    {steps.map((s, index) => (
                        <li
                            key={index}
                            className={`step dark:text-white ${
                                step >= index + 1 ? "step-primary" : ""
                            }`}
                        >
                            {s.title}
                        </li>
                    ))}
                </ul>

                <div className="flex justify-center mt-5">{form.form}</div>

                <div className="flex justify-between mt-10">
                    <button
                        onClick={onPrev}
                        className="btn btn-accent text-white py-2 px-4 rounded-lg mr-4"
                        disabled={step === 1 ?? "true"}
                    >
                        Previous
                    </button>
                    <button
                        onClick={onNext}
                        className="btn btn-primary hover:bg-blue-600 text-white py-2 px-4 rounded-lg"
                        disabled={step === totalSteps ?? "true"}
                    >
                        Next
                    </button>
                </div>
            </div>
        </div>
    );
}

export default Stepper;
