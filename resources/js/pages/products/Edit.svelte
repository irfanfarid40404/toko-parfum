<script lang="ts">
    import { Form, Link } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import InputError from '@/components/InputError.svelte';
    import { Button } from '@/components/ui/button';
    import { Input } from '@/components/ui/input';
    import { Label } from '@/components/ui/label';

    type Props = {
        product: {
            id: string;
            category_id: string;
            name: string;
            sku: string;
            description: string | null;
            price: string;
            stock: number;
            is_active: boolean;
        };
        categories: Array<{ id: string; name: string }>;
    };

    let { product, categories }: Props = $props();
</script>

<AppHead title={`Edit ${product.name}`} />

<div class="mx-auto w-full max-w-3xl space-y-6 p-6 lg:p-8">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">Edit Produk</h1>
        <Link href="/products"><Button variant="outline">Kembali</Button></Link>
    </div>

    <Form action={`/products/${product.id}`} method="put" class="space-y-6 rounded-xl border bg-card p-6 shadow-sm">
        {#snippet children({ errors, processing })}
            <div class="grid gap-2">
                <Label for="category_id">Kategori</Label>
                <select
                    id="category_id"
                    name="category_id"
                    required
                    class="h-9 rounded-md border border-input bg-background px-3 text-sm"
                >
                    {#each categories as category}
                        <option
                            value={category.id}
                            selected={category.id === product.category_id}
                        >
                            {category.name}
                        </option>
                    {/each}
                </select>
                <InputError message={errors.category_id} />
            </div>

            <div class="grid gap-2">
                <Label for="name">Nama Produk</Label>
                <Input id="name" name="name" value={product.name} required />
                <InputError message={errors.name} />
            </div>

            <div class="grid gap-2">
                <Label for="sku">SKU</Label>
                <Input id="sku" name="sku" value={product.sku} required />
                <InputError message={errors.sku} />
            </div>

            <div class="grid gap-2">
                <Label for="description">Deskripsi</Label>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="rounded-md border border-input bg-background px-3 py-2 text-sm"
                >{product.description ?? ''}</textarea>
                <InputError message={errors.description} />
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div class="grid gap-2">
                    <Label for="price">Harga</Label>
                    <Input
                        id="price"
                        name="price"
                        type="number"
                        min="0"
                        step="0.01"
                        value={product.price}
                        required
                    />
                    <InputError message={errors.price} />
                </div>
                <div class="grid gap-2">
                    <Label for="stock">Stok</Label>
                    <Input
                        id="stock"
                        name="stock"
                        type="number"
                        min="0"
                        value={String(product.stock)}
                        required
                    />
                    <InputError message={errors.stock} />
                </div>
            </div>

            <label class="flex items-center gap-2 text-sm">
                <input type="hidden" name="is_active" value="0" />
                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    checked={product.is_active}
                />
                Produk aktif
            </label>
            <InputError message={errors.is_active} />

            <Button type="submit" disabled={processing}>Simpan Perubahan</Button>
        {/snippet}
    </Form>
</div>
