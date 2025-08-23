<?php $this->theme->header(); ?>

<main>
    <div class="container">
        <h3 class="py-3">Pages <a href="/admin/pages/create">create page</a></h3>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>

            <?php $index = 1; ?>
            <?php foreach ($pages as $page) { ?>

                <tr>
                    <th scope="row">
                        <?= $index++; ?>
                    </th>
                    <td>
                        <a href="/admin/pages/<?= $page['id'] ?>"><?= $page['title'] ?></a>
                    </td>
                    <td>
                        <?= $page['date'] ?>
                    </td>
                    <td>
                        <a href="/admin/pages/<?= $page['id'] ?>">Edit</a>
                    </td>
                </tr>

            <?php } ?>

            </tbody>
        </table>
    </div>
</main>

<?php $this->theme->footer(); ?>


