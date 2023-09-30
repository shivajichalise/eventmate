import { Link, Head } from "@inertiajs/react";
import Footer from "../../Components/Footer.jsx";
import NavBar from "../../Components/NavBar.jsx";

const todayDate = () => {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, "0"); // Months are 0-based
    const day = String(today.getDate()).padStart(2, "0");

    return `${year}${month}${day}`;
};

export default function Invoice({
    auth,
    user,
    event,
    sub_event,
    ticket,
    amounts,
    invoice,
    pay_url,
    signed_field_names,
    signature,
    success_url,
    failure_url,
}) {
    return (
        <>
            <Head title="Invoice" />

            <NavBar auth={auth} />

            <div className="max-w-5xl mx-auto py-16 bg-white">
                <article className="overflow-hidden">
                    <div className="bg-gray-100 rounded-t-md">
                        <div className="flex justify-between p-9">
                            <div className="space-y-6 text-slate-700">
                                <img
                                    src="/images/logo/png/eventmate_blue-nav-wordmark-08.png"
                                    alt="Event<ate logo"
                                    className="h-32 mr-2 inline-block"
                                />
                            </div>
                            <div>
                                <a
                                    href={`/invoices/download/` + invoice.id}
                                    className="btn btn-square btn-xs btn-primary"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        strokeWidth={3}
                                        stroke="currentColor"
                                        className="w-4 h-4"
                                    >
                                        <path
                                            strokeLinecap="round"
                                            strokeLinejoin="round"
                                            d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"
                                        />
                                    </svg>
                                </a>
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
                                        <p>{user.name}</p>
                                        <p>Bhayerthan, Chorepatan</p>
                                        <p>Pokhara</p>
                                        <p>33700</p>
                                    </div>
                                    <div className="text-sm font-light text-slate-500">
                                        <p className="text-sm font-normal text-slate-700">
                                            Invoice Number
                                        </p>
                                        <p>
                                            INV-
                                            {todayDate()}- 0001
                                        </p>

                                        <p className="mt-2 text-sm font-normal text-slate-700">
                                            Date of Issue
                                        </p>
                                        <p>
                                            {
                                                new Date()
                                                    .toISOString()
                                                    .split("T")[0]
                                            }
                                        </p>
                                    </div>
                                    {/*
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
                                    */}
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
                                                    {sub_event.name}
                                                </div>
                                                <div className="mt-0.5 text-slate-500 sm:hidden">
                                                    1 unit at {ticket.currency}
                                                    {ticket.price}
                                                </div>
                                            </td>
                                            <td className="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell">
                                                1
                                            </td>
                                            <td className="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell">
                                                {ticket.currency} {ticket.price}
                                            </td>
                                            <td className="py-4 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                                {ticket.currency} {ticket.price}
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th
                                                scope="row"
                                                colSpan="3"
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
                                                {"NPR "}
                                                {amounts["subTotal"]}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th
                                                scope="row"
                                                colSpan="3"
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
                                                {"NPR "}
                                                {amounts["tax"]}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th
                                                scope="row"
                                                colSpan="3"
                                                className="hidden pt-6 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0"
                                            >
                                                Service charge
                                            </th>
                                            <th
                                                scope="row"
                                                className="pt-6 pl-4 pr-3 text-sm font-light text-left text-slate-500 sm:hidden"
                                            >
                                                Service charge
                                            </th>
                                            <td className="pt-6 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                                {"NPR "}
                                                {amounts["service_charge"]}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th
                                                scope="row"
                                                colSpan="3"
                                                className="hidden pt-6 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0"
                                            >
                                                Delivery charge
                                            </th>
                                            <th
                                                scope="row"
                                                className="pt-6 pl-4 pr-3 text-sm font-light text-left text-slate-500 sm:hidden"
                                            >
                                                Delivery charge
                                            </th>
                                            <td className="pt-6 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                                {"NPR "}
                                                {amounts["delivery_charge"]}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th
                                                scope="row"
                                                colSpan="3"
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
                                                NPR 0.00
                                            </td>
                                        </tr>
                                        <tr>
                                            <th
                                                scope="row"
                                                colSpan="3"
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
                                                {"NPR "}
                                                {amounts["total"]}
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

                <div className="bg-gray-200 p-4">
                    <h2 className="text-lg font-semibold">Payment Methods</h2>
                    <div className="flex mt-2">
                        <div className="mr-4">
                            <form action={pay_url} method="POST">
                                <input
                                    value={amounts["total"]}
                                    name="tAmt"
                                    type="hidden"
                                />
                                <input
                                    value={amounts["subTotal"]}
                                    name="amt"
                                    type="hidden"
                                />
                                <input
                                    value={amounts["tax"]}
                                    name="txAmt"
                                    type="hidden"
                                />
                                <input
                                    value={amounts["service_charge"]}
                                    name="psc"
                                    type="hidden"
                                />
                                <input
                                    value={amounts["delivery_charge"]}
                                    name="pdc"
                                    type="hidden"
                                />
                                <input
                                    value="EPAYTEST"
                                    name="scd"
                                    type="hidden"
                                />
                                <input
                                    value={ticket.uniqueId}
                                    name="pid"
                                    type="hidden"
                                />
                                <input
                                    value={success_url}
                                    type="hidden"
                                    name="su"
                                />
                                <input
                                    value={failure_url}
                                    type="hidden"
                                    name="fu"
                                />
                                <button type="submit" className="">
                                    <img
                                        src="/images/esewa_logo.png"
                                        alt="Esewa"
                                        className="w-12 h-12 mr-2 inline-block"
                                    />
                                </button>
                            </form>
                            {/*
                            <form action={pay_url} method="POST">
                                <input
                                    value={amounts["subTotal"]}
                                    name="amount"
                                    type="hidden"
                                />
                                <input
                                    value={amounts["tax"]}
                                    name="tax_amount"
                                    type="hidden"
                                />
                                <input
                                    value={amounts["total"]}
                                    name="total_amount"
                                    type="hidden"
                                />
                                <input
                                    value={ticket.uniqueId}
                                    name="transaction_uuid"
                                    type="hidden"
                                />
                                <input
                                    value="8gBm/:&EnhH.1/q"
                                    name="product_code"
                                    type="hidden"
                                />
                                <input
                                    value={amounts["service_charge"]}
                                    name="product_service_charge"
                                    type="hidden"
                                />
                                <input
                                    value={amounts["delivery_charge"]}
                                    name="product_delivery_charge"
                                    type="hidden"
                                />
                                <input
                                    value={success_url}
                                    type="hidden"
                                    name="success_url"
                                />
                                <input
                                    value={failure_url}
                                    type="hidden"
                                    name="failure_url"
                                />
                                <input
                                    value={signed_field_names}
                                    type="hidden"
                                    name="signed_field_names"
                                />
                                <input
                                    value={signature}
                                    type="hidden"
                                    name="signature"
                                />
                                <button type="submit" className="">
                                    <img
                                        src="/images/esewa_logo.png"
                                        alt="Esewa"
                                        className="w-12 h-12 mr-2 inline-block"
                                    />
                                </button>
                            </form>
                                */}
                        </div>
                    </div>
                </div>
            </div>

            <Footer />
        </>
    );
}
