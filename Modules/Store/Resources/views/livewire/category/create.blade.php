<div wire:ignore.self class="modal fade" id="createModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                 <div class="form-group">
                    <label for="name">Kategori</label>
                    <input type="text" wire:model="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Nama Kategori">
                  </div>
                  <div class="form-group">
                    <label for="image">Gambar</label>
                    <div wire:ignore x-data="{ image: @entangle('image') }"
                        x-init="() => {
                            FilePond.registerPlugin(
                                FilePondPluginImagePreview,
                                FilePondPluginImageCrop,
                                FilePondPluginImageResize,
                                FilePondPluginImageTransform,
                                FilePondPluginImageEdit
                            );
                            const file = FilePond.create($refs.input);
                                file.setOptions({
                                    allowProcess: true,
                                    server: {
                                        process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                            @this.upload('image', file, load, error, progress)
                                        },
                                        revert: (filename, load) => {
                                            @this.removeUpload('image', filename, load)
                                        },
                                        load: (source, load, error, progress, abort, headers) => {
                                            var myRequest = new Request(source);
                                            fetch(myRequest).then(function(response) {
                                                response.blob().then(function(myBlob) {
                                                load(myBlob)
                                                });
                                            });         
                                        }
                                    },
                                });
                            }">
                            <input type="file" x-ref="input" />
                        </div>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary" data-dismiss="modal">Simpan</button>
            </div>
       </div>
    </div>
</div>