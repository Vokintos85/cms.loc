<?php $view->render('header'); ?>

<main>
    <div class="container">
        <h3 class="py-3">Create a new page</h3>

        <form id="formPage">
            <div class="form-group">
                <label for="formTitle">
                    Title
                </label>
                <input type="text" class="form-control" id="formTitle" aria-describedby="titleHelp" placeholder="Enter page title">
                <small id="titleHelp" class="form-text text-muted">
                    The title will be displayed as the page heading.
                </small>
            </div>

            <div class="form-group">
                <label for="redactor">Content</label>
                <textarea name="content" id="redactor" class="form-control" placeholder="Write the content here"></textarea>
                <small id="contentHelp" class="form-text text-muted">
                    Add the main text or HTML for the page.
                </small>
            </div>
        </form>

        <button type="submit" class="btn btn-primary" onclick="page.add()">
            Publish
        </button>
    </div>
</main>

<?php $view->render('footer'); ?>

