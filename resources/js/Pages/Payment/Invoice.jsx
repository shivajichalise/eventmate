import { Link, Head } from "@inertiajs/react";
import Footer from "../../Components/Footer.jsx";
import NavBar from "../../Components/NavBar.jsx";

export default function Invoice({ auth }) {
    return (
        <>
            <Head title="Invoice" />

            <NavBar auth={auth} />

            <div className="max-w-5xl mx-auto py-16 bg-white">
                <article className="overflow-hidden">
                    <div className="bg-gray-100 rounded-b-md">
                        <div className="p-9">
                            <div className="space-y-6 text-slate-700">
                                <svg
                                    className="object-cover h-12"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M3.938 6.497a6.958 6.958 0 0 0-.702 1.694L0 9v2l3.236.809c.16.6.398 1.169.702 1.694l-1.716 2.861 1.414 1.414 2.86-1.716a6.958 6.958 0 0 0 1.695.702L9 20h2l.809-3.236a6.96 6.96 0 0 0 1.694-.702l2.861 1.716 1.414-1.414-1.716-2.86a6.958 6.958 0 0 0 .702-1.695L20 11V9l-3.236-.809a6.958 6.958 0 0 0-.702-1.694l1.716-2.861-1.414-1.414-2.86 1.716a6.958 6.958 0 0 0-1.695-.702L11 0H9l-.809 3.236a6.96 6.96 0 0 0-1.694.702L3.636 2.222 2.222 3.636l1.716 2.86zM10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"
                                        fill-rule="evenodd"
                                    ></path>
                                </svg>

                                <p className="text-xl font-extrabold tracking-tight uppercase font-body">
                                    EventMate
                                </p>
                            </div>
                        </div>
                        <div className="p-9">
                            <div className="flex w-full">
                                <div className="grid grid-cols-4 gap-12">
                                    <div className="text-sm font-light text-slate-500">
                                        <p className="text-sm font-normal text-slate-700">
                                            Invoice Detail:
                                        </p>
                                        <p>EventMate</p>
                                        <p>Srijana Chowk</p>
                                        <p>Pokhara - 8</p>
                                        <p>Nepal 33700</p>
                                    </div>
                                    <div className="text-sm font-light text-slate-500">
                                        <p className="text-sm font-normal text-slate-700">
                                            Billed To
                                        </p>
                                        <p>The Boring Company</p>
                                        <p>Tesla Street 007</p>
                                        <p>Frisco</p>
                                        <p>CA 0000</p>
                                    </div>
                                    <div className="text-sm font-light text-slate-500">
                                        <p className="text-sm font-normal text-slate-700">
                                            Invoice Number
                                        </p>
                                        <p>000000</p>

                                        <p className="mt-2 text-sm font-normal text-slate-700">
                                            Date of Issue
                                        </p>
                                        <p>00.00.00</p>
                                    </div>
                                    <div className="text-sm font-light text-slate-500">
                                        <p className="text-sm font-normal text-slate-700">
                                            Terms
                                        </p>
                                        <p>0 Days</p>

                                        <p className="mt-2 text-sm font-normal text-slate-700">
                                            Due
                                        </p>
                                        <p>00.00.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="p-9">
                            <div className="flex flex-col mx-0 mt-8">
                                <table className="min-w-full divide-y divide-slate-500">
                                    <thead>
                                        <tr>
                                            <th
                                                scope="col"
                                                className="py-3.5 pl-4 pr-3 text-left text-sm font-normal text-slate-700 sm:pl-6 md:pl-0"
                                            >
                                                Description
                                            </th>
                                            <th
                                                scope="col"
                                                className="hidden py-3.5 px-3 text-right text-sm font-normal text-slate-700 sm:table-cell"
                                            >
                                                Quantity
                                            </th>
                                            <th
                                                scope="col"
                                                className="hidden py-3.5 px-3 text-right text-sm font-normal text-slate-700 sm:table-cell"
                                            >
                                                Rate
                                            </th>
                                            <th
                                                scope="col"
                                                className="py-3.5 pl-3 pr-4 text-right text-sm font-normal text-slate-700 sm:pr-6 md:pr-0"
                                            >
                                                Amount
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr className="border-b border-slate-200">
                                            <td className="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0">
                                                <div className="font-medium text-slate-700">
                                                    Tesla Truck
                                                </div>
                                                <div className="mt-0.5 text-slate-500 sm:hidden">
                                                    1 unit at $0.00
                                                </div>
                                            </td>
                                            <td className="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell">
                                                48
                                            </td>
                                            <td className="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell">
                                                $0.00
                                            </td>
                                            <td className="py-4 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                                $0.00
                                            </td>
                                        </tr>
                                        <tr className="border-b border-slate-200">
                                            <td className="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0">
                                                <div className="font-medium text-slate-700">
                                                    Tesla Charging Station
                                                </div>
                                                <div className="mt-0.5 text-slate-500 sm:hidden">
                                                    1 unit at $75.00
                                                </div>
                                            </td>
                                            <td className="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell">
                                                4
                                            </td>
                                            <td className="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell">
                                                $0.00
                                            </td>
                                            <td className="py-4 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                                $0.00
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th
                                                scope="row"
                                                colspan="3"
                                                className="hidden pt-6 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0"
                                            >
                                                Subtotal
                                            </th>
                                            <th
                                                scope="row"
                                                className="pt-6 pl-4 pr-3 text-sm font-light text-left text-slate-500 sm:hidden"
                                            >
                                                Subtotal
                                            </th>
                                            <td className="pt-6 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                                $0.00
                                            </td>
                                        </tr>
                                        <tr>
                                            <th
                                                scope="row"
                                                colspan="3"
                                                className="hidden pt-6 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0"
                                            >
                                                Discount
                                            </th>
                                            <th
                                                scope="row"
                                                className="pt-6 pl-4 pr-3 text-sm font-light text-left text-slate-500 sm:hidden"
                                            >
                                                Discount
                                            </th>
                                            <td className="pt-6 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                                $0.00
                                            </td>
                                        </tr>
                                        <tr>
                                            <th
                                                scope="row"
                                                colspan="3"
                                                className="hidden pt-4 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0"
                                            >
                                                Tax
                                            </th>
                                            <th
                                                scope="row"
                                                className="pt-4 pl-4 pr-3 text-sm font-light text-left text-slate-500 sm:hidden"
                                            >
                                                Tax
                                            </th>
                                            <td className="pt-4 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                                $0.00
                                            </td>
                                        </tr>
                                        <tr>
                                            <th
                                                scope="row"
                                                colspan="3"
                                                className="hidden pt-4 pl-6 pr-3 text-sm font-normal text-right text-slate-700 sm:table-cell md:pl-0"
                                            >
                                                Total
                                            </th>
                                            <th
                                                scope="row"
                                                className="pt-4 pl-4 pr-3 text-sm font-normal text-left text-slate-700 sm:hidden"
                                            >
                                                Total
                                            </th>
                                            <td className="pt-4 pl-3 pr-4 text-sm font-normal text-right text-slate-700 sm:pr-6 md:pr-0">
                                                $0.00
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div className="mt-48 p-9">
                            <div className="border-t pt-9 border-slate-200">
                                <div className="text-sm font-light text-slate-700">
                                    <p>
                                        Payment terms are 14 days. Please be
                                        aware that according to the Late Payment
                                        of Unwrapped Debts Act 0000, freelancers
                                        are entitled to claim a 00.00 late fee
                                        upon non-payment of debts after this
                                        time, at which point a new invoice will
                                        be submitted with the addition of this
                                        fee. If payment of the revised invoice
                                        is not received within a further 14
                                        days, additional interest will be
                                        charged to the overdue account and a
                                        statutory rate of 8% plus Bank of
                                        England base of 0.5%, totalling 8.5%.
                                        Parties cannot contract out of the Act’s
                                        provisions.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <Footer />
        </>
    );
}
