<a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info">Visualizar</a>
<a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">Editar</a>
<form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Excluir</button>
</form>
