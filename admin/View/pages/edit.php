<?php $this->theme->header(); ?>

    <main>
        <div class="container">
            <h3 class="py-3">Edit page</h3>

            <form id="editPageForm">
                <input type="hidden" name="page_id" id="formPageId" value="<?= $page_id ?? ''; ?>">

                <div class="form-group">
                    <label for="pageTitle">Title</label>
                    <input type="text"
                           class="form-control"
                           id="formTitle"
                           name="title"
                           placeholder="Enter page title"
                           value="<?= htmlspecialchars($title ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="redactor">Content</label>
                    <textarea name="content" id="redactor" class="form-control"><?= htmlspecialchars($content ?? ''); ?></textarea>
                </div>

                <button type="button" class="btn btn-primary" onclick="page.update()">
                    Update Page
                </button>
            </form>
        </div>
    </main>

    <script>
        var page = {
            ajaxMethod: 'POST',

            update: function() {
                var formData = new FormData();

                formData.append('page_id', $('#formPageId').val());
                formData.append('title', $('#formTitle').val());
                formData.append('content', $('#redactor').val());

                $.ajax({
                    url: '/admin/page/update/',
                    type: this.ajaxMethod,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(result) {
                        console.log('Result:', result);

                        try {
                            var response = JSON.parse(result);
                            if (response.success) {
                                alert('✅ Page updated successfully!');
                            } else {
                                alert('❌ Error: ' + response.error);
                            }
                        } catch (e) {
                            alert('⚠️ Server response: ' + result);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('🚫 Request error: ' + error);
                    }
                });
            }
        };
    </script>

<?php $this->theme->footer(); ?>