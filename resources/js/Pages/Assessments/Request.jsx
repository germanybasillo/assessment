import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Request({ auth }) {
    const { assessments = { data: [], current_page: 1, last_page: 1, prev_page_url: null, next_page_url: null } } =
        usePage().props; // Destructure with a fallback to avoid "undefined"

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Request" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">
                            <h2 className="text-lg font-semibold mb-4 text-blue-500">Assessment Requests</h2>

                            

                            {/* Table for Assessments */}
                            <table className="table-auto w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr className="bg-blue-900 text-white">
                                        <th className="border border-blue-300 px-4 py-2">ID</th>
                                        <th className="border border-blue-300 px-4 py-2">Title</th>
                                        <th className="border border-blue-300 px-4 py-2">Status</th>
                                        <th className="border border-blue-300 px-4 py-2">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>

                                {assessments.data.length === 0 ? (
        <tr>
            <td
                colSpan="4"
                className="border border-gray-300 px-4 py-2 text-center text-blue-500"
            >
                No requests found.
            </td>
        </tr>
    ) : (
        assessments.data.map((assessment, index) => (
            <tr key={index} className="text-center">
                <td className="border border-gray-300 px-4 py-2">{assessment.id}</td>
                <td className="border border-gray-300 px-4 py-2">{assessment.title}</td>
                <td className="border border-gray-300 px-4 py-2">{assessment.status}</td>
                <td className="border border-gray-300 px-4 py-2">
                    {new Date(assessment.created_at).toLocaleDateString()}
                </td>
            </tr>
        ))
    )}
                                </tbody>

                            </table>

                            {/* Pagination Controls */}
                            <div className="mt-4 flex justify-between items-center">
                                {assessments.prev_page_url && (
                                    <Link
                                        href={assessments.prev_page_url}
                                        className="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700"
                                    >
                                        Previous
                                    </Link>
                                )}
                                <span className="text-blue-700">
                                    Page {assessments.current_page} of {assessments.last_page}
                                </span>
                                {assessments.next_page_url && (
                                    <Link
                                        href={assessments.next_page_url}
                                        className="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700"
                                    >
                                        Next
                                    </Link>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
