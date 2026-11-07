import { Head } from "@inertiajs/react";
import { DataTable } from "@/components/ui/data-table";
import { columns, Category } from "./columns";
import  AppLayout from "@/layouts/app-layout";

interface IndexProps {
    categories: Category[]
}

export default function Index({ categories }: IndexProps) {
    return (
        <>
            <AppLayout
                breadcrumbs={[
                    { title: "Dashboard", href: "/dashboard" },
                    { title: "Categorías", href: "/categorias" },
                ]}
            >
                <Head title="Categorías" />

                <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                    <div className="flex items-center justify-between">
                        <h1 className="text-2xl font-bold tracking-tight">
                            Gestión de Categorías
                        </h1>
                    </div>

                    {/* Pasamos las columnas y los datos a la DataTable con filtro */}
                    <div className="rounded-lg border bg-card p-6 shadow-sm">
                        <DataTable
                            columns={columns}
                            data={categories}
                            searchKey="nombre"
                        />
                    </div>
                </div>
            </AppLayout>
        </>
    );
}


