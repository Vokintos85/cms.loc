<?php $view->render('header'); ?>

<main>
    <div class="container">
        <div class="row">
            <div class="col page-title d-flex justify-content-between align-items-center">
                <h3 class="py-3 mb-0">Plugins</h3>
                <a href="/admin/plugins/upload" class="btn btn-success">
                    <i class="fa fa-upload"></i> Upload Plugin
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th class="text-end">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($plugins as $plugin): ?>
                        <tr>
                            <td><?= htmlspecialchars($plugin['name']) ?></td>
                            <td>
                                <?php if ($plugin['enabled']): ?>
                                    <span class="badge bg-success">Enabled</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Disabled</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($plugin['description']) ?></td>
                            <td class="text-end">
                                <form method="post" action="/admin/plugins/toggle">
                                    <input type="hidden" name="plugin" value="<?= htmlspecialchars($plugin['slug']) ?>">
                                    <?php if ($plugin['enabled']): ?>
                                        <button type="submit" class="btn btn-sm btn-danger">Disable</button>
                                    <?php else: ?>
                                        <button type="submit" class="btn btn-sm btn-primary">Enable</button>
                                    <?php endif; ?>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php $view->render('footer'); ?>
