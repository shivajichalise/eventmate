export default function CallToAction() {
    return (
        <div className="flex justify-center items-center mt-10 mb-5">
            <div className="flex flex-col lg:flex-row justify-around items-center bg-primary rounded-xl w-11/12 p-10">
                <div className="flex flex-col justify-center items-center mb-10 lg:mb-0 lg:w-3/5 lg:items-start">
                    <h1 className="text-3xl md:text-4xl font-black p-1 text-white text-center lg:text-left">
                        Start Planning Your Event Today!
                    </h1>
                    <div className="flex flex-col p-1 items-center lg:items-start">
                        <p className="text-md md:text-md text-white text-center lg:text-left">
                            Ready to bring your event to life? Begin the journey
                            now by following these four simple steps.
                        </p>
                        <p className="text-md md:text-md text-white font-bold">
                            Let's make your vision a reality!
                        </p>
                    </div>
                    <a
                        className="btn btn-white mt-5 w-fit"
                        href="/organizers/register"
                    >
                        Get Started
                    </a>
                </div>
                <div className="lg:w-2/6">
                    <img
                        src="/images/call_to_action.png"
                        className="h-64 object-contain"
                    />
                </div>
            </div>
        </div>
    );
}
