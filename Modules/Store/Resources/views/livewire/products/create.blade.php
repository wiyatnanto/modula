<div>
    <x-crud::molecules.card>
        <h5 class="mb-4">Upload Produk</h5>
        <div class="row">
            <div class="col-md-4">
                <p class="mb-2"><strong>Foto Produk</strong> <span class="badge bg-light text-dark">wajib</span>
                </p>
                <p>Format gambar .jpg .jpeg .png dan ukuran minimum 300 x 300px (Untuk gambar
                    optimal
                    gunakan ukuran minimum 700 x 700 px).</p>
                <p>Cantumkan min. 3 foto yang menarik agar produk semakin menarik pembeli.</p>
            </div>
            <div class="col-md-8">
                <div class="row row-sm mt-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <div class="col-6 col-sm">
                            <div class="mg-b-30">
                                <div wire:ignore x-data x-init="() => {
                                    FilePond.registerPlugin(
                                        FilePondPluginImagePreview,
                                        FilePondPluginImageCrop,
                                        FilePondPluginImageResize,
                                        FilePondPluginImageTransform,
                                        FilePondPluginImageEdit
                                    );
                                    const file = FilePond.create($refs.input);
                                    file.setOptions({
                                        labelIdle: `<img src='/modules/store/img/image-upload.svg'><br/><span class='tx-14-f'>Foto Utama</span>`,
                                        imageCropAspectRatio: '1:1',
                                        stylePanelLayout: 'integrated',
                                        styleButtonRemoveItemPosition: 'left',
                                        labelFileProcessingComplete: 'Uploaded',
                                        allowProcess: true,
                                        instantUpload: true,
                                        server: {
                                            process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                                @this.upload('images.{{ $i }}', file, load, error, progress)
                                            },
                                            revert: (filename, load) => {
                                                @this.removeUpload('images.{{ $i }}', filename, load)
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
                                @error('images' . $i)
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </x-crud::molecules.card>
    <x-crud::molecules.card class="mt-3">
        <p class="mb-2">
            <strong>Try On</strong>
            <span class="badge bg-light text-dark">optional</span>
        </p>
        <p class="mb-3">Format gambar .jpg .jpeg .png dan ukuran minimum resulusi 500px (Untuk gambar optimal gunakan
            ukuran minimum resolusi 800px).</p>
        <div class="col-md-12">
            <div class="frames" wire:ignore>
                <div class="frame frame-right dragTarget">
                    <div class="line"></div>
                    <div wire:ignore style="position: relative;" x-data="{
                        imageConfigJson: @entangle('image_config_json')
                    }" x-init="() => {
                        let moveable_right = new Moveable(document.body, {
                            target: $($refs.gright),
                            container: document.body,
                            className: 'moveable-gright',
                            draggable: true,
                            resizable: true,
                            scalable: true,
                            rotatable: false,
                            warpable: true,
                            pinchable: true,
                            origin: true,
                            keepRatio: true,
                            edge: false,
                            throttleDrag: 0,
                            throttleResize: 0,
                            throttleScale: 0,
                            throttleRotate: 0
                        });
                    
                        moveable_right.dragTarget = document.querySelector('.dragTarget');
                    
                        moveable_right.on('dragStart', ({ target, clientX, clientY }) => {
                            console.log('onDragStart', target);
                        }).on('drag', ({
                            target,
                            transform,
                            left,
                            top,
                            right,
                            bottom,
                            beforeDelta,
                            beforeDist,
                            delta,
                            dist,
                            clientX,
                            clientY,
                        }) => {
                            $($refs.gright)[0].style.left = `${left}px`;
                            $($refs.gright)[0].style.top = `${top}px`;
                            @this.set('image_config_json.image_right.position.left', left)
                            @this.set('image_config_json.image_right.position.top', top)
                        }).on('dragEnd', ({ target, isDrag, clientX, clientY }) => {
                            console.log('onDragEnd', target, isDrag);
                        });
                    
                        moveable_right.on('resizeStart', ({ target, clientX, clientY }) => {
                            console.log('onResizeStart', target);
                        }).on('resize', ({ target, width, height, dist, delta, clientX, clientY }) => {
                            delta[0] && ($($refs.gright)[0].style.width = `${width}px`);
                            delta[1] && ($($refs.gright)[0].style.height = `${height}px`);
                            @this.set('image_config_json.image_right.size.width', width)
                            @this.set('image_config_json.image_right.size.height', height)
                        }).on('resizeEnd', ({ target, isDrag, clientX, clientY }) => {
                            console.log('onResizeEnd', target, isDrag);
                        });
                    
                        $($refs.gright).click(
                            function(e) {
                                $('.moveable-gright').find('.moveable-direction').show();
                            }
                        );
                    
                        $($refs.gright).on('mousedown touchstart', function() {
                            $('.moveable-gright').find('.moveable-direction').hide();
                        }).bind('mouseup touchend', function() {
                            $('.moveable-gright').find('.moveable-direction').show();
                        });
                    
                        window.addEventListener('updateImageRight', event => {
                            $refs.gright.src = event.detail
                        })
                    }">
                        <img class="glasses-right" x-ref="gright" src="{{ url('storage/store/glasses/right.png') }}"
                            style="width: 250px;" />
                    </div>
                </div>
                <div class="frame frame-front">
                    <div class="line"></div>
                    <div style="position: relative;" x-data="{
                        imageConfigJson: @entangle('image_config_json')
                    }" x-init="() => {
                        let frameWidth = $('.frame-front').outerWidth();
                        let prevLeft = document.getElementById('preview').offsetLeft
                        let prevTop = document.getElementById('preview').offsetTop
                    
                        let moveable_front = new Moveable(document.body, {
                            target: $($refs.gfront),
                            container: document.body,
                            className: 'moveable-gfront',
                            draggable: true,
                            resizable: true,
                            scalable: true,
                            rotatable: false,
                            warpable: true,
                            pinchable: true,
                            origin: true,
                            keepRatio: true,
                            edge: false,
                            throttleDrag: 0,
                            throttleResize: 0,
                            throttleScale: 0,
                            throttleRotate: 0,
                        });
                    
                        moveable_front.on('dragStart', ({ target, clientX, clientY }) => {
                            console.log('onDragStart', target);
                        }).on('drag', ({
                            target,
                            transform,
                            left,
                            top,
                            right,
                            bottom,
                            beforeDelta,
                            beforeDist,
                            delta,
                            dist,
                            clientX,
                            clientY,
                        }) => {
                            $($refs.gfront)[0].style.left = `${left}px`;
                            $($refs.gfront)[0].style.top = `${top}px`;
                            let margin = (250 - parseFloat($($refs.gfront)[0].style.width)) / 2
                            $('.glasses-preview')[0].style.left = `${left}px`;
                            $('.glasses-preview')[0].style.top = `${top + 65}px`;
                            @this.set('image_config_json.image_front.position.left', left)
                            @this.set('image_config_json.image_front.position.top', top)
                        }).on('dragEnd', ({ target, isDrag, clientX, clientY }) => {
                            console.log('onDragEnd', target, isDrag);
                        });
                    
                        moveable_front.on('resizeStart', ({ target, clientX, clientY }) => {
                            console.log('onResizeStart', target);
                        }).on('resize', ({ target, width, height, dist, delta, clientX, clientY }) => {
                            delta[0] && ($($refs.gfront)[0].style.width = `${width}px`);
                            delta[1] && ($($refs.gfront)[0].style.height = `${height}px`);
                            $('.glasses-preview')[0].style.width = `${width}px`;
                            $('.glasses-preview')[0].style.height = `${height}px`;
                            @this.set('image_config_json.image_front.size.width', width)
                            @this.set('image_config_json.image_front.size.height', height)
                        }).on('resizeEnd', ({ target, isDrag, clientX, clientY }) => {
                            console.log('onResizeEnd', target, isDrag);
                        });
                    
                        $($refs.gfront).click(
                            function() {
                                $('.moveable-gfront').find('.moveable-direction').show();
                            }
                        );
                    
                        $($refs.gfront).on('mousedown touchstart', function() {
                            $('.moveable-gfront').find('.moveable-direction').hide();
                        }).bind('mouseup touchend', function() {
                            $('.moveable-gfront').find('.moveable-direction').show();
                        });
                    
                        $(document).click(function(e) {
                            if (!$(e.target).is('.glasses-right')) {
                                $('.moveable-gright').find('.moveable-direction').hide();
                            }
                            if (!$(e.target).is('.glasses-front')) {
                                $('.moveable-gfront').find('.moveable-direction').hide();
                            }
                            if (!$(e.target).is('.glasses-left')) {
                                $('.moveable-gleft').find('.moveable-direction').hide();
                            }
                        });
                    
                        window.addEventListener('updateImageFront', event => {
                            $refs.gfront.src = event.detail
                        })
                    }">
                        <img class="glasses-front" x-ref="gfront" src="{{ url('storage/store/glasses/front.png') }}"
                            style="width: 250px;" />
                    </div>
                </div>
                <div class="frame frame-left">
                    <div class="line"></div>
                    <div style="position: relative;" x-data="{}" x-init="() => {
                        let moveable_left = new Moveable(document.body, {
                            target: $($refs.gleft),
                            container: document.body,
                            className: 'moveable-gleft',
                            draggable: true,
                            resizable: true,
                            scalable: true,
                            rotatable: false,
                            warpable: true,
                            pinchable: true,
                            origin: true,
                            keepRatio: true,
                            edge: false,
                            throttleDrag: 0,
                            throttleResize: 0,
                            throttleScale: 0,
                            throttleRotate: 0,
                        });
                    
                        moveable_left.on('dragStart', ({ target, clientX, clientY }) => {
                            console.log('onDragStart', target);
                        }).on('drag', ({
                            target,
                            transform,
                            left,
                            top,
                            right,
                            bottom,
                            beforeDelta,
                            beforeDist,
                            delta,
                            dist,
                            clientX,
                            clientY,
                        }) => {
                            $($refs.gleft)[0].style.left = `${left}px`;
                            $($refs.gleft)[0].style.top = `${top}px`;
                            @this.set('image_config_json.image_left.position.left', left)
                            @this.set('image_config_json.image_left.position.top', top)
                        }).on('dragEnd', ({ target, isDrag, clientX, clientY }) => {
                            console.log('onDragEnd', target, isDrag);
                        });
                    
                        moveable_left.on('resizeStart', ({ target, clientX, clientY }) => {
                            console.log('onResizeStart', target);
                        }).on('resize', ({ target, width, height, dist, delta, clientX, clientY }) => {
                            delta[0] && ($($refs.gleft)[0].style.width = `${width}px`);
                            delta[1] && ($($refs.gleft)[0].style.height = `${height}px`);
                            @this.set('image_config_json.image_left.size.width', width)
                            @this.set('image_config_json.image_left.size.height', height)
                        }).on('resizeEnd', ({ target, isDrag, clientX, clientY }) => {
                            console.log('onResizeEnd', target, isDrag);
                        });
                    
                        $($refs.gleft).click(
                            function(e) {
                                $('.moveable-gleft').find('.moveable-direction').show();
                            }
                        );
                    
                        $($refs.gleft).on('mousedown touchstart', function() {
                            $('.moveable-gleft').find('.moveable-direction').hide();
                        }).bind('mouseup touchend', function() {
                            $('.moveable-gleft').find('.moveable-direction').show();
                        });
                    
                        window.addEventListener('updateImageLeft', event => {
                            $refs.gleft.src = event.detail
                        })
                    }">
                        <img class="glasses-left" x-ref="gleft" src="{{ url('storage/store/glasses/left.png') }}"
                            style="width: 250px;" />
                    </div>
                </div>
                <div class="frame frame-preview ms-2 rounded" id="preview"
                    style="background-image: url('{{ url('storage/store/glasses/person.png') }}'); background-position: center; background-size: cover; object-fit: cover;">
                    <div class="line-preview"></div>
                    <div style="position: relative;" x-data="{
                        showImage: false
                    }" x-init="() => {
                        let frameWidth = $('.frame-preview').outerWidth();
                        let prevLeft = document.getElementById('preview').offsetLeft
                        let prevTop = document.getElementById('preview').offsetTop
                    
                        $($refs.gpreview)[0].style.width = `${frameWidth}px`;
                        $($refs.gpreview)[0].style.maxWidth = `${frameWidth}px`;
                    
                        let moveable = new Moveable(document.body, {
                            target: $($refs.gpreview),
                            container: document.body,
                            className: 'moveable-gpreview',
                            draggable: false,
                            resizable: false,
                            scalable: false,
                            rotatable: false,
                            warpable: false,
                            pinchable: false,
                            origin: false,
                            keepRatio: false,
                            edge: false,
                            throttleDrag: 0,
                            throttleResize: 0,
                            throttleScale: 0,
                            throttleRotate: 0,
                        });
                    
                        window.addEventListener('updateImagePreview', event => {
                            $refs.gpreview.src = event.detail
                        })
                    }">
                        <img x-show="showImage" class="glasses-preview" x-ref="gpreview"
                            src="{{ url('storage/store/glasses/front.png') }}"
                            style="width: 250px; scale: 0.62;transform-origin: top center;display: none;" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="border rounded-3 p-3 mt-3">
                <div class="row">
                    <div class="col-md-12">
                        {{ json_encode($image_config_json) }}
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="image_right" class="form-label">{{ __('Gambar Kanan') }}</label>
                            <x-crud::atoms.input type="file" id="image_right" wire:model="imageRight" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="image_right" class="form-label">{{ __('Gambar Tengah') }}</label>
                            <x-crud::atoms.input type="file" id="image_right" wire:model="imageFront" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="image_right" class="form-label">{{ __('Gambar Kiri') }}</label>
                            <x-crud::atoms.input type="file" id="image_right" wire:model="imageLeft" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="image_right" class="form-label">{{ __('Lebar Frame') }}</label>
                            <div class="input-group">
                                <x-crud::atoms.input wire:model="image_config_json.frame_width"
                                    placeholder="Lebar Frame (cm)" />
                                <div class="input-group-prepend">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-crud::molecules.card>
    <x-crud::molecules.card class="mt-3">
        <h5 class="mb-4">Informasi Produk</h5>
        <div class="row mb-3">
            <div class="col-md-4">
                <p class="mb-2">
                    <strong>Nama Produk</strong>
                    <span class="badge bg-light text-dark">wajib</span>
                </p>
                <p>
                    Cantumkan min. 40 karakter agar semakin menarik dan mudah ditemukan
                    oleh pembeli, terdiri dari jenis produk, merek, dan keterangan seperti warna, bahan, atau
                    tipe.
                </p>
            </div>
            <div class="col-md-8">
                <input wire:model="name" type="text" id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Nama produk (maksimum 70 karakter)">
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <p class="mb-2"><strong>Brand</strong>
                    <span class="badge bg-light text-dark">wajib</span>
                </p>
                <p>Kamu dapat menambah brand baru atau memilih dari daftar brand yang ada
                </p>
            </div>
            <div class="col-md-8">
                <div wire:ignore>
                    <div x-data="{ selected: '' }" x-init="select = $($refs.select).select2({
                        placeholder: 'Pilih Brand'
                    });
                    select.on('select2:select', function(e) {
                        selected = event.target.value;
                        @this.set('brand', e.target.value);
                    });
                    select.val('').trigger('change');">
                        <select x-ref="select" class="form-select wd-100p" data-placeholder="Pilih Brand">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @error('brand')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <p><strong>Kategori</strong>
                    <span class="badge bg-light text-dark">wajib</span>
                </p>
            </div>
            <div class="col-md-8">
                <div wire:ignore class="mb-3">
                    <div x-data="{
                        test: @js($categoriesTrees),
                        languages: [{
                                'indexcode': '1',
                                'name': 'Front-End',
                                's': [{
                                        'indexcode': '11',
                                        'name': 'HTML',
                                        's': [{
                                                'indexcode': '111',
                                                'name': 'HTML'
                                            },
                                            {
                                                'indexcode': '112',
                                                'name': 'XML'
                                            },
                                            {
                                                'indexcode': '113',
                                                'name': 'HTML5'
                                            },
                                            {
                                                'indexcode': '111',
                                                'name': 'HTML'
                                            },
                                            {
                                                'indexcode': '112',
                                                'name': 'XML'
                                            },
                                            {
                                                'indexcode': '113',
                                                'name': 'HTML5'
                                            },
                                            {
                                                'indexcode': '111',
                                                'name': 'HTML'
                                            },
                                            {
                                                'indexcode': '112',
                                                'name': 'XML'
                                            },
                                            {
                                                'indexcode': '113',
                                                'name': 'HTML5'
                                            },
                                            {
                                                'indexcode': '111',
                                                'name': 'HTML'
                                            },
                                            {
                                                'indexcode': '112',
                                                'name': 'XML'
                                            },
                                            {
                                                'indexcode': '113',
                                                'name': 'HTML5'
                                            },
                                            {
                                                'indexcode': '111',
                                                'name': 'HTML'
                                            },
                                            {
                                                'indexcode': '112',
                                                'name': 'XML'
                                            },
                                            {
                                                'indexcode': '113',
                                                'name': 'HTML5'
                                            },
                                            {
                                                'indexcode': '111',
                                                'name': 'HTML'
                                            },
                                            {
                                                'indexcode': '112',
                                                'name': 'XML'
                                            },
                                            {
                                                'indexcode': '113',
                                                'name': 'HTML5'
                                            }
                                        ]
                                    },
                                    {
                                        'indexcode': '12',
                                        'name': 'CSS',
                                        's': [{
                                                'indexcode': '121',
                                                'name': 'CSS'
                                            },
                                            {
                                                'indexcode': '122',
                                                'name': 'CSS3'
                                            },
                                            {
                                                'indexcode': '123',
                                                'name': 'CSS4'
                                            },
                                        ]
                                    },
                                    {
                                        'indexcode': '13',
                                        'name': 'JavaScript',
                                        's': [{
                                                'indexcode': '131',
                                                'name': 'jQuery'
                                            },
                                            {
                                                'indexcode': '122',
                                                'name': 'Angular'
                                            },
                                            {
                                                'indexcode': '123',
                                                'name': 'React'
                                            },
                                        ]
                                    },
                                ]
                            },
                            {
                                'indexcode': '2',
                                'name': 'Back-End',
                                's': [{
                                        'indexcode': '21',
                                        'name': 'C',
                                        's': [{
                                                'indexcode': '211',
                                                'name': 'C'
                                            },
                                            {
                                                'indexcode': '212',
                                                'name': 'C++'
                                            },
                                            {
                                                'indexcode': '213',
                                                'name': 'C#'
                                            },
                                        ]
                                    },
                                    {
                                        'indexcode': '22',
                                        'name': 'Database',
                                        's': [{
                                                'indexcode': '221',
                                                'name': 'MySql'
                                            },
                                            {
                                                'indexcode': '222',
                                                'name': 'SQL'
                                            },
                                            {
                                                'indexcode': '223',
                                                'name': 'Oracle'
                                            },
                                        ]
                                    },
                                    {
                                        'indexcode': '23',
                                        'name': 'Others',
                                        's': [{
                                                'indexcode': '231',
                                                'name': 'Node.js'
                                            },
                                            {
                                                'indexcode': '122',
                                                'name': 'Python'
                                            },
                                            {
                                                'indexcode': '123',
                                                'name': 'Ruby'
                                            },
                                        ]
                                    },
                                ]
                            }
                        ]
                    }" x-init="() => {
                        var aaaa = @js($categoriesTrees);
                        console.log(aaaa)
                        aaaa.forEach(function(item) {
                            item.label = item.name
                            item.value = item.id
                            item.children = item.children
                            if (item.children && item.children.length) {
                                item.children.forEach(function(item2) {
                                    item2.label = item2.name
                                    item2.value = item2.id
                                    item2.children = item2.children
                                    if (item2.children && item2.children.length) {
                                        item2.children.forEach(function(item3) {
                                            item3.label = item3.name
                                            item3.value = item3.id
                                            item3.children = item3.children
                                        })
                                    }
                                })
                            }
                        })
                        console.log('asdaasdasd', aaaa)
                        languages.forEach(function(item) {
                            item.label = item.name
                            item.value = item.indexcode
                            item.children = item.s
                            item.active = true
                            item.s.forEach(function(item2) {
                                item2.label = item2.name
                                item2.value = item2.indexcode
                                item2.active = true
                                if (item2.s && item2.s.length) {
                                    item2.children = item2.s
                                    item2.s.forEach(function(item3) {
                                        item3.label = item3.name
                                        item3.value = item3.indexcode
                                        item3.active = true
                                    })
                                }
                            })
                        })
                        console.log(test)
                        select = $($refs.selectbox).zdCascader({
                            data: aaaa,
                            container: '#test',
                            onChange: function(value, label, datas) {
                                console.log(value, label, datas);
                            }
                        });
                    
                    
                    }">
                        <input type="text" class="form-control" x-ref="selectbox" placeholder="Kategori" />
                    </div>
                </div>
                {{-- custom --}}
                <div wire:ignore>
                    <div x-data="{ selected: '' }" x-init="select = $($refs.select).select2({
                        placeholder: 'Pilih Kategori'
                    });
                    select.on('select2:select', function(e) {
                        selected = event.target.value;
                        @this.set('category', e.target.value);
                    });
                    select.val('').trigger('change');">
                        <select x-ref="select" class="form-select wd-100p" data-placeholder="Pilih Kategori">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @error('category')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p class="mb-2"><strong>Etalase</strong>
                    <span class="badge bg-light text-dark">wajib</span>
                </p>
                <p>Kamu dapat menambah etalase baru atau memilih dari daftar etalase yang ada
                </p>
            </div>
            <div class="col-md-8">
                <div wire:ignore>
                    <div x-data="{ selected: @entangle('storefront') }" x-init="select = $($refs.select).select2({
                        tags: true,
                        placeholder: 'Pilih Etalase'
                    });
                    select.on('change', function(e) {
                        @this.set('storefront', $($refs.select).select2('data'));
                    });
                    select.val(selected).trigger('change');">
                        <select x-ref="select" class="form-select wd-100p" multiple="multiple"
                            data-placeholder="Pilih Etalase">
                            @foreach ($storefronts as $storefront)
                                <option value="{{ $storefront->id }}">{{ $storefront->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @error('storefront')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </x-crud::molecules.card>
    <x-crud::molecules.card class="mt-3">
        <h5 class="mb-4">Detail Produk</h5>
        <div class="row">
            <div class="col-md-4">
                <p class="mb-2">Deskripsi Produk <span class="badge bg-light text-dark">wajib</span>
                </p>
                <p>Pastikan deskripsi produk memuat spesifikasi,
                    ukuran, bahan, masa berlaku, dan lainnya. Semakin detail, semakin
                    berguna bagi pembeli, cantumkan min. 260 karakter agar pembeli
                    semakin mudah mengerti dan menemukan produk anda</p>
            </div>
            <div class="col-md-8">
                <div class="mt-2">
                    <x-crud::atoms.froala-editor wire:model="description" />
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </x-crud::molecules.card>
    <x-crud::molecules.card class="mt-3">
        <div class="row">
            <h5 class="mb-4">Varian Produk</h5>
            <div class="d-flex justify-content-between align-self-center mb-3">
                <div>
                    <p>Tambahkan varian seperti warna, ukuran, atau lainnya.</p>
                </div>
                <div>
                    @if ($hasVarian)
                        <button wire:click="$set('hasVarian', false)" class="btn btn-xs btn-danger btn-icon-text">
                            <i class="far fa-times btn-icon-prepend"></i> Remove Varian</button>
                    @else
                        <button wire:click="$set('hasVarian', true)" class="btn btn-xs btn-primary btn-icon-text">
                            <i class="far fa-plus btn-icon-prepend"></i> Varian</button>
                    @endif
                </div>
            </div>
            @if ($hasVarian)
                <div class="col-md-12">
                    {{ json_encode($variants) }}
                    <table>
                        @if (count($variants) > 0)
                            @foreach ($variants as $key => $variant)
                                <tr>
                                    <td width="300" class="pe-3">
                                        <label>Tipe Varian {{ $key + 1 }}</label>
                                        <div wire:ignore class="mb-3" x-data x-init="() => {
                                            let select = $($refs.select)
                                            select.select2({
                                                tags: true,
                                                maximumSelectionLength: 2,
                                                placeholder: 'Pilih Varian'
                                            });
                                            select.on('select2:select', function(e) {
                                                Livewire.emit('selectAttributes', {{ $key }}, e.target.value)
                                            })
                                        }">
                                            <select x-ref="select" class="form-select">
                                                @foreach ($variantOptions as $variant)
                                                    <option></option>
                                                    <option value="{{ $variant->name }}">{{ $variant->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td width="600">
                                        <label>Pilihan Varian {{ $key + 1 }}</label>
                                        <div wire:ignore class="mb-3" wire:key="value.{{ $key }}">
                                            <div x-data="{
                                                selected: @entangle('variants'),
                                                disabled: true
                                            }" x-init="() => {
                                                var select = $($refs.select)
                                            
                                                function initSelect2() {
                                                    select.select2({
                                                        tags: true,
                                                        placeholder: 'Value'
                                                    });
                                                }
                                                initSelect2()
                                            
                                                select.on('change', function(e) {
                                                    Livewire.emit('selectAttributeValues', {{ $key }}, $($refs.select).select2('data'))
                                                });
                                            
                                                $watch('selected', (value) => {
                                                    disabled = value[0].name !== null ? false : true
                                                });
                                            
                                                Livewire.on('updateAttributeValueOptions', params => {
                                                    if ({{ $key }} === params.index) {
                                                        select.empty().select2({
                                                            tags: true,
                                                            data: params.options.map(function(item) {
                                                                return { id: item.value, text: item.value }
                                                            })
                                                        }).trigger('change');
                                                    }
                                                })
                                            }">
                                                <select x-ref="select" class="wd-100p" multiple="multiple"
                                                    id="option-{{ $key }}" data-placeholder="Varian"
                                                    x-bind:disabled="disabled">
                                                    {{-- @if ($attributeValueOptions)
                                                        @foreach ($attributeValueOptions as $valueOption)
                                                            <option>{{ $valueOption->value }}</option>
                                                        @endforeach
                                                    @endif --}}
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    @if ($key !== 0)
                                        <td class="10%">
                                            <label class="d-none">Remove</label>
                                            <div class="mt-3 mb-3">
                                                <x-crud::atoms.button size="md" color="link" class="btn-icon">
                                                    <x-crud::atoms.icon icon="trash-alt" class="text-danger"
                                                        wire:click="removeVarian({{ $key }})" />
                                                    {{ $key }}
                                                </x-crud::atoms.button>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @endif
                        </tr>
                    </table>
                </div>
                <div class="col-md-12">
                    @if (count($variants) < 4)
                        @if ($variants[count($variants) - 1]['name'] !== null && count($variants[count($variants) - 1]['values']) > 0)
                            <button wire:key="addVarian" wire:click="addVarian()"
                                class="btn btn-xs btn-primary btn-icon-text">
                                <i class="far fa-plus btn-icon-prepend"></i> Tambah Varian
                            </button>
                        @else
                            <button wire:key="disableAddVarian" class="btn btn-xs btn-primary btn-icon-text" disabled>
                                <i class="far fa-plus btn-icon-prepend"></i> Tambah Varian
                            </button>
                        @endif
                    @endif
                </div>
                @if (count($variants) > 0)
                    <div class="col-md-12">
                        <div class="mt-3">
                            @php
                                foreach ($variants as $variant) {
                                    if (count($variant['values']) > 0) {
                                        if (isset($attributesCount)) {
                                            $attributesCount *= count($variant['values']);
                                        } else {
                                            $attributesCount = count($variant['values']);
                                        }
                                    }
                                }
                            @endphp
                            {{-- {{ json_encode($variants) }}
                            <br />
                            {{ json_encode($productVariants) }}
                            <br />
                            {{ json_encode($productVariantSelected) }}
                            <br />
                            {{ json_encode(collect($productVariantDatas)) }} --}}
                            @if (count($productVariants) > 0)
                                <div class="mb-3 mt-3">
                                    <x-crud::atoms.checkbox wire:model="bulkSelectVariant"
                                        label="{{ count(
                                            $productVariants->filter(function ($variant, $key) {
                                                return isset($variant['selected']) && $variant['selected'];
                                            }),
                                        ) > 0
                                            ? count(
                                                    $productVariants->filter(function ($variant, $key) {
                                                        return isset($variant['selected']) && $variant['selected'];
                                                    }),
                                                ) . ' varian produk terpilih'
                                            : 'Pilih beberapa varian' }}" />
                                </div>
                                <div class="border border-1 rounded-3 p-3">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td></td>
                                                    @foreach ($variants as $variant)
                                                        @if (count($variant['values']) > 0)
                                                            <th>{{ $variant['name'] }}</th>
                                                        @endif
                                                    @endforeach
                                                    <th>Harga</th>
                                                    <th>SKU</th>
                                                    <th>Stok</th>
                                                    <th>Berat</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($bulkSelectVariant)
                                                    <tr style="background-color: #e9ecef;height: 80px;">
                                                        <td class="align-middle"
                                                            colspan="{{ count($variants) + 1 }}">
                                                            {{ __('Atur dan terapkan data varian') }}
                                                        </td>
                                                        <td class="align-middle">
                                                            <div x-data x-init="price = $($refs.price).maskMoney({ thousands: '.', precision: 0 });
                                                            $($refs.price).on('change.maskMoney', function() {
                                                                @this.set('bulkVariantValues.price', $($refs.price).val());
                                                            });">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Rp.</span>
                                                                    </div>
                                                                    <input type="text" x-ref="price"
                                                                        class="form-control @error('bulkVariantValues.price') is-invalid @enderror"
                                                                        placeholder="Harga">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle">
                                                            <x-crud::atoms.input wire:model="bulkVariantValues.sku"
                                                                placeholder="SKU" />
                                                        </td>
                                                        <td class="align-middle">
                                                            <x-crud::atoms.input type="number"
                                                                wire:model="bulkVariantValues.quantity"
                                                                placeholder="Stock" />
                                                        </td>
                                                        <td class="align-middle">
                                                            <div class="input-group">
                                                                <x-crud::atoms.input
                                                                    wire:model="bulkVariantValues.weight"
                                                                    placeholder="Weight" />
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">g</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle">
                                                            <x-crud::atoms.button size="sm"
                                                                wire:click="setBulkVariant">
                                                                Terapkan
                                                            </x-crud::atoms.button>
                                                        </td>
                                                    </tr>
                                                @endif
                                                @foreach ($productVariants as $key => $productVariant)
                                                    <tr
                                                        style="{{ isset($productVariant['selected']) ? 'background-color: #f4f5f7;' : '' }}">
                                                        <td class="align-middle">
                                                            <x-crud::atoms.checkbox
                                                                wire:model="productVariants.{{ $key }}.selected" />
                                                        </td>
                                                        @foreach ($productVariant['variants'] as $variant)
                                                            <td class="align-middle">{{ $variant }}</td>
                                                        @endforeach
                                                        <td class="align-middle">
                                                            <div x-data x-init="price = $($refs.price).maskMoney({ thousands: '.', precision: 0 });
                                                            $($refs.price).on('change.maskMoney', function() {
                                                                @this.set('productVariants.{{ $key }}.price', $($refs.price).val());
                                                            });">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Rp.</span>
                                                                    </div>
                                                                    <input type="text" x-ref="price"
                                                                        class="form-control @error('price') is-invalid @enderror"
                                                                        wire:model="productVariants.{{ $key }}.price"
                                                                        placeholder="Harga">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle">
                                                            <x-crud::atoms.input
                                                                wire:model="productVariants.{{ $key }}.sku"
                                                                placeholder="SKU" />
                                                        </td>
                                                        <td class="align-middle">
                                                            <x-crud::atoms.input type="number"
                                                                wire:model="productVariants.{{ $key }}.quantity"
                                                                placeholder="Stock" />
                                                        </td>
                                                        <td class="align-middle">
                                                            <div class="input-group">
                                                                <x-crud::atoms.input
                                                                    wire:model="productVariants.{{ $key }}.weight"
                                                                    placeholder="Weight" />
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">g</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle">
                                                            <x-crud::atoms.switch
                                                                wire:model="productVariants.{{ $key }}.status" />
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </x-crud::molecules.card>
    <x-crud::molecules.card class="mt-3">
        <h5 class="mb-4">Harga</h5>
        <div class="row mb-3">
            <div class="col-md-4">
                <p>Minimum Pemesanan</p>
                <p>Atur jumlah minimum yang harus dibeli untuk
                    produk ini.</p>
            </div>
            <div class="col-md-8">
                <input wire:model="minOrder" type="number" class="form-control" placeholder="Masukkan Minimum" />
                @error('minOrder')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <p class="mb-2"><strong>Harga Satuan</strong>
                    <span class="badge bg-light text-dark">wajib</span>
                </p>
            </div>
            <div class="col-md-8">
                <div x-data="{ selected: '' }" x-init="price = $($refs.price).maskMoney({ thousands: '.', precision: 0 });
                $($refs.price).on('change.maskMoney', function() {
                    @this.set('price', $($refs.price).val());
                });">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="text" x-ref="price"
                            class="form-control @error('price') is-invalid @enderror" placeholder="Harga">
                        @error('price')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Potongan Harga (Diskon)</strong></p>
            </div>
            <div class="col-md-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" class="form-control" placeholder="0" aria-label="Rp">
                </div>
            </div>
        </div>
    </x-crud::molecules.card>
    <x-crud::molecules.card class="mt-3">
        <h5 class="mb-4">Pengeloaan Produk</h5>
        <div class="row mb-3">
            <div class="col-md-4">
                <p class="mb-2"><strong>Status Produk</strong></p>
            </div>
            <div class="col-md-8">
                <x-crud::atoms.switch type="checkbox" checked disabled />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <p><strong>Stok Produk </strong><span class="badge bg-light text-dark">wajib</span></p>
            </div>
            <div class="col-md-8">
                <input wire:model="quantity" type="number"
                    class="form-control @error('quantity') is-invalid @endif"
                    placeholder="Masukkan Jumlah Stok">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <p class="mb-2"><strong>SKU (Stock Keeping Unit)</strong></p>
                <p>Gunakan kode unik SKU jika kamu ingin menandai produkmu.</strong>
                </p>
            </div>
            <div class="col-md-8">
                <input wire:model="sku" type="text" class="mg-t-20 form-control @error('sku') is-invalid @endif"
                    placeholder="Masukkan SKU">
            </div>
        </div>
    </x-crud::molecules.card>
    <x-crud::molecules.card class="mt-3">
        <h5 class="mb-4">Berat dan Pengiriman Produk</h5>
        <div class="row mb-3">
            <div class="col-md-4">
                <p class="mb-2"><strong>Berat Produk</strong></p>
                <p>Masukkan berat dengan menimbang produk
                    <strong>setelah dikemas</strong>
                </p>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3">
                        <div wire:ignore>
                            <div x-data="{ selected: '' }" x-init="select = $($refs.select).select2({
                                placeholder: 'Berat Produk'
                            });
                            select.on('select2:select', function(e) {
                                selected = event.target.value;
                                @this.set('weightType', e.target.value);
                            });
                            select.val('gr').trigger('change');
                            @this.set('weightType', 'gr');">
                                <select x-ref="select" class="wd-100p" data-placeholder="Berat Produk">
                                    <option value="gr">Gram (gr)</option>
                                    <option value="kg">Kilogram (kg)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <input wire:model="weight" type="text" class="form-control"
                            placeholder="Masukkan Berat" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <p><strong>Ukuran Produk </strong><span class="badge bg-light text-dark">wajib</span></p>
                <p>Masukkan ukuran produk setelah dikemas untuk menghitung berat volume</p>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="input-group mg-b-10">
                            <input wire:model="length" type="text" class="form-control @error('length') is-invalid @endif"
                    placeholder="Panjang" aria-describedby="aria-panjang">
                <div class="input-group-append">
                    <span class="input-group-text" id="aria-panjang">cm</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="input-group mg-b-10">
                <input wire:model="width" type="text" class="form-control" placeholder="Lebar"
                    aria-describedby="aria-lebar" />
                <div class="input-group-append">
                    <span class="input-group-text" id="aria-lebar">cm</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="input-group mg-b-10">
                <input wire:model="height" type="text" class="form-control" placeholder="Tinggi"
                    aria-describedby="aria-tinggi">
                <div class="input-group-append">
                    <span class="input-group-text" id="aria-tinggi">cm</span>
                </div>
            </div>
        </div>
    </x-crud::molecules.card>
    <div class="d-flex justify-content-end mt-3">
        <a href="{{ url('store/products') }}" type="button" class="btn btn-sm btn-light me-2">Batal</a>
        <button wire:click.prevent="storeAndNew()" type="button" class="btn btn-sm btn-secondary me-2">Simpan &
            Tambah Baru</button>
        <button wire:click.prevent="store()" type="button" class="btn btn-sm btn-primary">Simpan</button>
    </div>
</div>
</div>

@push('style')
    <link rel="stylesheet" href="{{ asset('css/store.css') }}" />
    <style>
        .card {
            border-radius: 8px;
        }

        .card-body {
            padding-left: 2rem;
            padding-right: 2rem;
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }

        .card-body strong {
            font-weight: 500 !important;
        }

        .card-body p {
            color: #31353b;
        }

        .filepond--root .filepond--credits {
            display: none !important
        }

        .filepond--root[data-style-panel-layout~=integrated] .filepond--image-preview-wrapper {
            border-radius: 5px
        }

        .filepond--image-existed {
            width: 123px;
            height: 123px;
            border: 1px solid #e1e5ed;
            border-radius: 5px
        }

        .filepond--image-existed img {
            border-radius: 5px
        }

        .filepond--root[data-style-panel-layout~=integrated] {
            background-color: #eaecf026;
            border-radius: 5px;
            height: 122px !important;
            width: 122px;
            border: 2px dashed #e1e5ed
        }

        .is-invalid .filepond--root[data-style-panel-layout~=integrated] {
            border: 2px dashed #ee828c;
            background-color: #fff0f2;
            opacity: 1
        }
    </style>
    <style>
        .frames {
            display: flex;
        }

        .frame {
            border: 1px solid #8e96aa;
            width: 250px;
            max-width: 250px;
            height: 250px;
        }

        .frame .glasses-right {
            position: absolute;
        }

        .frame .glasses-front {
            position: absolute;
        }

        .frame .glasses-left {
            position: absolute;
        }

        .frame .glasses-preview {
            position: absolute;
        }

        .frame-right {
            border-radius: 8px 0px 0px 8px !important;
            border-right: 0px;
            background-color: #ffffff;
            opacity: 1;
            background-image: repeating-linear-gradient(45deg, #dddddd 25%, transparent 25%, transparent 75%, #dddddd 75%, #dddddd), repeating-linear-gradient(45deg, #dddddd 25%, #ffffff 25%, #ffffff 75%, #dddddd 75%, #dddddd);
            background-position: 0 0, 5px 5px;
            background-size: 10px 10px;
        }

        .frame-front {
            background-color: #ffffff;
            opacity: 1;
            background-image: repeating-linear-gradient(45deg, #dddddd 25%, transparent 25%, transparent 75%, #dddddd 75%, #dddddd), repeating-linear-gradient(45deg, #dddddd 25%, #ffffff 25%, #ffffff 75%, #dddddd 75%, #dddddd);
            background-position: 0 0, 5px 5px;
            background-size: 10px 10px;
        }

        .frame-left {
            border-radius: 0px 8px 8px 0px !important;
            border-left: 0px;
            background-color: #ffffff;
            opacity: 1;
            background-image: repeating-linear-gradient(45deg, #dddddd 25%, transparent 25%, transparent 75%, #dddddd 75%, #dddddd), repeating-linear-gradient(45deg, #dddddd 25%, #ffffff 25%, #ffffff 75%, #dddddd 75%, #dddddd);
            background-position: 0 0, 5px 5px;
            background-size: 10px 10px;
        }

        .frame-person {
            border-radius: 8px;
        }

        .moveable-line,
        .moveable-direction {
            display: none;
        }

        .line {
            height: 2px;
            background-color: red;
            position: relative;
            top: 60px;
            width: 100%;
        }

        .line-preview {
            height: 2px;
            background-color: red;
            position: relative;
            top: 110px;
            width: 100%;
        }
    </style>
@endpush
@push('script')
    <script src="{{ asset('js/store.js') }}"></script>
@endpush
