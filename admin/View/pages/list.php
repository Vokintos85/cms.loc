<?php $this->theme->header(); ?>

<main>
    <div class="container">

        <!-- Заголовок + кнопка -->
        <div class="d-flex align-items-center justify-content-between py-3">
            <h3 class="mb-0">Pages</h3>
            <a href="/admin/pages/create" class="btn btn-primary btn-sm">Create page</a>
        </div>

        <?php if (empty($pages)) : ?>
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <div class="me-2">Пока страниц нет.</div>
                <a href="/admin/pages/create" class="alert-link">Создать первую</a>
            </div>
        <?php else : ?>

            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm align-middle mb-0">
                    <caption class="caption-top text-muted">Список страниц</caption>
                    <thead class="table-light">
                    <tr>
                        <th scope="col" style="width: 56px;">#</th>
                        <th scope="col">Title</th>
                        <th scope="col" class="text-nowrap" style="width: 160px;">Date</th>
                        <th scope="col" class="text-end" style="width: 120px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $index = 1; ?>
                    <?php foreach ($pages as $page) { ?>
                        <tr>
                            <th scope="row" class="text-muted"><?= $index++; ?></th>
                            <td>
                                <a class="link-body-emphasis text-decoration-none"
                                   href="/admin/pages/<?= $page['id'] ?>">
                                    <?= htmlspecialchars($page['title']) ?>
                                </a>
                            </td>
                            <td class="text-nowrap">
                                <time class="text-muted small"><?= htmlspecialchars($page['date']) ?></time>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Actions">
                                    <a class="btn btn-outline-secondary"
                                       href="/admin/pages/<?= $page['id'] ?>">Edit</a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

        <?php endif; ?>

    </div>
</main>

<?php $this->theme->footer(); ?>
