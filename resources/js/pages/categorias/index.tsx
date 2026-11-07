import { Head } from '@inertiajs/react';

export default function Index() {
    return (
        <>
            <Head title="Categorias Page" />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <h1 className="text-2xl font-bold">Categorias</h1>
            </div>
        </>
    );
}

Index.layout = {
    breadcrumbs: [
        {
            title: 'Categorias',
            href: '/categorias',
        },
    ],
}
