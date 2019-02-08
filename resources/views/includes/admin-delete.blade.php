<div class="modal fade modal-mini modal-primary" id="modalConfirm" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-small">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i>
                </button>
            </div>
            <div class="modal-body text-center">
                <p id="Mtext">Are you sure you want to do this?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-link" data-dismiss="modal">No</button>
                <a id="btnYes" href="" type="button" class="btn btn-success btn-link">Yes
                    <div class="ripple-container"></div>
                </a>
            </div>
        </div>
    </div>
</div>

<script>

    function confirmAction(url, text) {
        $('#Mtext').html(text);
        $('#btnYes').attr('href', url);
        $('#modalConfirm').modal('show');
    }


</script>