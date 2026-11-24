<script lang="ts">
    import { Form, Link } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import { Button } from '@/components/ui/button';

    type Product = {
        id: string;
        name: string;
        sku: string;
        price: string;
        stock: number;
        is_active: boolean;
        category: string;
    };

    type Props = {
        products: {
            data: Product[];
            links: Array<{ url: string | null; label: string; active: boolean }>;
        };
    };

    let { products }: Props = $props();
</script>

<AppHead title="Produk" />

<div class="mx-auto w-full max-w-[1500px] space-y-6 p-6 lg:p-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold">Data Produk</h1>
            <p class="mt-1 text-sm text-muted-foreground">
                Kelola katalog parfum toko.
            </p>
        </div>
        <Link href="/products/create">
            <Button class="w-full sm:w-auto">Tambah Produk</Button>
        </Link>
    </div>

    <div class="overflow-hidden rounded-xl border bg-card shadow-sm">
        <div class="overflow-x-auto">
        <table class="w-full min-w-[820px] text-sm">
            <thead class="border-b bg-muted/50">
                <tr>
                    <th class="px-6 py-4 text-left font-medium">Produk</th>
                    <th class="px-5 py-4 text-left font-medium">Kategori</th>
                    <th class="px-5 py-4 text-right font-medium">Harga</th>
                    <th class="px-5 py-4 text-right font-medium">Stok</th>
                    <th class="px-5 py-4 text-center font-medium">Status</th>
                    <th class="px-6 py-4 text-right font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {#each products.data as product}
                    <tr class="border-b transition-colors last:border-0 hover:bg-muted/30">
                        <td class="px-6 py-4">
                            <div class="font-medium">{product.name}</div>
                            <div class="text-xs text-muted-foreground">{product.sku}</div>
                        </td>
                        <td class="px-5 py-4">{product.category}</td>
                        <td class="px-5 py-4 text-right whitespace-nowrap">
                            Rp {Number(product.price).toLocaleString('id-ID')}
                        </td>
                        <td class="px-5 py-4 text-right">{product.stock}</td>
                        <td class="px-5 py-4 text-center">
                            <span
                                class={product.is_active
                                    ? 'inline-flex rounded-full bg-emerald-500/15 px-2.5 py-1 text-xs font-medium text-emerald-600 dark:text-emerald-400'
                                    : 'inline-flex rounded-full bg-muted px-2.5 py-1 text-xs font-medium text-muted-foreground'}
                            >
                                {product.is_active ? 'Aktif' : 'Nonaktif'}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                <Link href={`/products/${product.id}/edit`}>
                                    <Button variant="outline" size="sm">Edit</Button>
                                </Link>
                                <Form action={`/products/${product.id}`} method="delete">
                                    {#snippet children({ processing })}
                                        <Button
                                            type="submit"
                                            variant="destructive"
                                            size="sm"
                                            disabled={processing}
                                            onClick={(event) => {
                                                if (!confirm(`Hapus produk ${product.name}?`)) {
                                                    event.preventDefault();
                                                }
                                            }}
                                        >
                                            Hapus
                                        </Button>
                                    {/snippet}
                                </Form>
                            </div>
                        </td>
                    </tr>
                {:else}
                    <tr>
                        <td colspan="6" class="px-4 py-10 text-center text-muted-foreground">
                            Belum ada produk.
                        </td>
                    </tr>
                {/each}
            </tbody>
        </table>
        </div>
    </div>

    {#if products.links.length > 3}
        <div class="flex flex-wrap items-center gap-2 pt-1">
            {#each products.links as link}
                {#if link.url}
                    <Link href={link.url} preserveScroll>
                        <Button variant={link.active ? 'default' : 'outline'} size="sm">
                            {@html link.label}
                        </Button>
                    </Link>
                {/if}
            {/each}
        </div>
    {/if}
</div>
