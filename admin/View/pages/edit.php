<?php $this->theme->header(); ?>

<main>
    <div class="container">
        <h3 class="py-3">Edit page</h3>

        <form>
            <div class="form-group">
                <label for="pageTitle">
                    Title
                </label>
                <input type="text"
                       class="form-control"
                       id="pageTitle"
                       aria-describedby="titleHelp"
                       placeholder="Enter page title"
                       value="<?= $title; ?>">
                <small id="titleHelp" class="form-text text-muted">
                    The title will be displayed as the page heading.
                </small>
            </div>

            <div class="form-group">
                <label for="pageContent">Content</label>
                <textarea class="form-control"
                          id="pageContent"
                          rows="6"
                          placeholder="Write the content here"><?= $content; ?></textarea>
                <small id="contentHelp" class="form-text text-muted">
                    Add the main text or HTML for the page.
                </small>
            </div>

            <button type="submit" class="btn btn-primary">
                Publish
            </button>
        </form>
    </div>
</main>


<?php $this->theme->footer(); ?>
