<div id="product_info" class="tab-pane fade in active">

    <h3>{{ trans('admin.product_info') }}</h3>

    <div class="form-group">
        <label for="title">
            {{ trans('admin.product_title') }}
        </label>

        <input
            type="text"
            name="title"
            id="title"
            class="form-control"
            placeholder="{{ trans('admin.product_title') }}"
            value="{{ old('title', $product->title) }}"
        >
    </div>

    <div class="form-group">
        <label for="content">
            {{ trans('admin.product_content') }}
        </label>

        <textarea
            name="content"
            id="content"
            class="form-control"
            placeholder="{{ trans('admin.product_content') }}"
        >{{ old('content', $product->content) }}</textarea>
    </div>

</div>
