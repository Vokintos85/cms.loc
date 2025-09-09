<li class="list-group-item d-flex flex-column flex-md-row align-items-stretch gap-2 menu-item-<?= $item->id ?>" data-id="<?= $item->id ?>">
    <!-- Название -->
    <div class="d-flex align-items-center gap-2 flex-fill">
        <i class="icon-pencil icons text-body-secondary"></i>
        <input
           class="form-control form-control-sm menu-item-field"
           type="text"
           value="<?= $item->name ?>"
           placeholder="Name"
           data-id="<?= $item->id ?>"
           data-field="name"
           onchange="menu.updateItem(<?= $item->id ?>, 'name', this)"
        >
    </div>

    <!-- Ссылка -->
    <div class="d-flex align-items-center gap-2 flex-fill">
        <i class="icon-link icons text-body-secondary"></i>
        <input
           class="form-control form-control-sm menu-item-field"
           type="text"
           value="<?= $item->link ?>"
           placeholder="URL"
           data-id="<?= $item->id ?>"
           data-field="link"
           onchange="menu.updateItem(<?= $item->id ?>, 'link', this)"
        >
    </div>

    <!-- Действия -->
    <div class="d-flex align-items-center gap-2 ms-md-auto">
        <button type="button" class="btn btn-outline-danger btn-sm" onclick="menu.removeItem(<?= $item->id ?>)">
            <i class="icon-trash icons"></i>
        </button>
        <span class="drag-handle text-body-secondary" role="button" aria-label="Drag">
            <i class="icon-cursor-move icons"></i>
        </span>
    </div>
</li>