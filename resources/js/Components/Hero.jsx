export default function Hero({ img }) {
    return (
        <div className="hero min-h-fit flex items-center justify-center">
            <div className="bg-cover bg-center w-11/12 rounded-lg shadow-xl h-40">
                <img
                    src={img}
                    alt="Banner"
                    className="w-full h-full object-cover rounded-lg"
                />
                {/* Content within the hero section */}
            </div>
        </div>
    );
}
