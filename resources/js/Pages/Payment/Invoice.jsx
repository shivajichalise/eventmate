import { Link, Head } from "@inertiajs/react";
import Footer from "../../Components/Footer.jsx";
import NavBar from "../../Components/NavBar.jsx";

export default function Invoice({ auth }) {
    return (
        <>
            <Head title="Invoice" />

            <NavBar auth={auth} />

            <div className="container mx-auto p-4">
                <div className="bg-gray-100 rounded-lg shadow-md p-8">
                    <h1 className="text-2xl font-bold mb-4">Invoice</h1>
                    <div className="mb-4">
                        <p className="font-bold">Client Name</p>
                        <p>John Doe</p>
                    </div>
                    <div className="mb-4">
                        <p className="font-bold">Invoice Number</p>
                        <p>INV-001</p>
                    </div>
                    <div className="mb-4">
                        <p className="font-bold">Invoice Date</p>
                        <p>2023-04-07</p>
                    </div>
                    <div className="mb-4">
                        <p className="font-bold">Payment Method</p>
                        <p>Credit Card</p>
                    </div>
                    <div>
                        <h2 className="text-xl font-bold mb-4">Items</h2>
                        <table className="w-full">
                            <thead>
                                <tr>
                                    <th className="py-2">Item</th>
                                    <th className="py-2">Quantity</th>
                                    <th className="py-2">Price</th>
                                    <th className="py-2">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td className="py-2">Product 1</td>
                                    <td className="py-2">2</td>
                                    <td className="py-2">$10</td>
                                    <td className="py-2">$20</td>
                                </tr>
                                <tr>
                                    <td className="py-2">Product 2</td>
                                    <td className="py-2">1</td>
                                    <td className="py-2">$15</td>
                                    <td className="py-2">$15</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div className="mt-4">
                        <p className="font-bold">Notes</p>
                        <p>Thank you for your business!</p>
                    </div>
                    <div className="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <p className="font-bold">Subtotal</p>
                            <p>$35</p>
                        </div>
                        <div>
                            <p className="font-bold">Tax</p>
                            <p>$5</p>
                        </div>
                        <div>
                            <p className="font-bold">Total</p>
                            <p>$40</p>
                        </div>
                    </div>
                    <button className="bg-blue-500 text-white px-4 py-2 rounded mt-6">
                        Print Invoice
                    </button>
                </div>
            </div>

            <Footer />
        </>
    );
}
