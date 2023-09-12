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

                {form.form}

                <div className="flex justify-between mt-10">
                    <button
                        onClick={onPrev}
                        className="btn btn-accent text-white py-2 px-4 rounded-lg mr-4"
                    >
                        Previous
                    </button>
                    {step < totalSteps ? (
                        <button
                            onClick={onNext}
                            className="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg"
                        >
                            Next
                        </button>
                    ) : (
                        <button className="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg">
                            Submit
                        </button>
                    )}
                </div>
            </div>
        </div>
    );
}

export default Stepper;
