@extends('layouts.backend')
@push('style')
    <style>
        .progress-wrapper {
            margin-top: 12px;
            display: none;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            margin-bottom: 6px;
            color: #6c757d;
        }

        .progress {
            height: 8px;
            background-color: #e9ecef;
            border-radius: 6px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #4e73df, #1cc88a);
            border-radius: 6px;
            transition: width 0.4s ease;
        }
    </style>
@endpush
@section('content')
    <main id="main-container">
        <div class="content content-boxed">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Upload Audio</h3>
                </div>
                <div class="block-content">

                    <form id="uploadForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row push">
                            <div class="col-lg-8 col-xl-5 m-auto">
                                <div class="mb-4">
                                    <label class="form-label" for="zip">Audio Zip</label>
                                    <input class="form-control" type="file" name="zip_file" accept=".zip" required>
                                </div>

                                <div id="progressWrapper" class="progress-wrapper mb-4">
                                    <div class="progress-info">
                                        <span id="progressLabel">Uploading...</span>
                                        <span id="progressText">0%</span>
                                    </div>

                                    <div class="progress">
                                        <div id="progressBar" class="progress-bar" style="width:0%"></div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-alt-primary">
                                        Upload ZIP
                                    </button>
                                </div>
                                <div id="result" style="margin-top:15px;"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Audios</h3>
                    <div class="block-options space-x-1">
                        <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                            data-target="#one-dashboard-search-orders" data-class="d-none">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <div id="one-dashboard-search-orders" class="block-content border-bottom d-none">
                    <div class="push">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-alt" id="audioSearch" name="search"
                                placeholder="Search all Audios..">
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter" id="audioTable">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 80px;">#</th>
                                    <th>File Name</th>
                                    <th class="text-center" style="width: 120px;">Download Link</th>
                                </tr>
                            </thead>
                            <tbody id="audioTableBody">
                                @include('backend.audio.partials.table_rows')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('script')
    <script>
        /**
         * Reload audio table after upload
         */
        function reloadAudioTable() {
            fetch("{{ route('audio.list') }}")
                .then(response => response.text())
                .then(html => {
                    document.getElementById('audioTableBody').innerHTML = html;
                })
                .catch(error => {
                    console.error('Table reload failed', error);
                });
        }

        /**
         * Upload form submit
         */
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            const xhr = new XMLHttpRequest();

            const progressWrapper = document.getElementById('progressWrapper');
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const progressLabel = document.getElementById('progressLabel');
            const result = document.getElementById('result');

            // Reset UI
            result.innerHTML = '';
            progressBar.style.width = '0%';
            progressText.innerText = '0%';
            progressLabel.innerText = 'Uploading...';
            progressWrapper.style.display = 'block';

            xhr.open('POST', "{{ route('audio.upload') }}", true);
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

            // Upload progress
            xhr.upload.onprogress = function(e) {
                if (e.lengthComputable) {
                    const percent = Math.round((e.loaded / e.total) * 100);

                    progressBar.style.width = percent + '%';
                    progressText.innerText = percent + '%';

                    if (percent === 100) {
                        progressLabel.innerText = 'Processing...';
                    }
                }
            };

            // Upload + processing completed
            xhr.onload = function() {
                progressWrapper.style.display = 'none';

                if (xhr.status === 200) {
                    showToast('Audio uploaded successfully', 'success');
                    form.reset();

                    // 🔥 Reload table instantly
                    reloadAudioTable();
                } else {
                    result.innerHTML = `
                <div style="color:#e74a3b;font-weight:500;">
                    ❌ Upload failed
                </div>
            `;
                }
            };

            // Network error
            xhr.onerror = function() {
                progressWrapper.style.display = 'none';
                result.innerHTML = `
            <div style="color:#e74a3b;font-weight:500;">
                ❌ Network error
            </div>
        `;
            };

            xhr.send(formData);
        });
    </script>
    <script>
        const searchInput = document.getElementById('audioSearch');

        let searchTimeout = null;

        searchInput.addEventListener('keyup', function() {
            clearTimeout(searchTimeout);

            searchTimeout = setTimeout(() => {
                fetch("{{ route('audio.search') }}?q=" + encodeURIComponent(this.value))
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('audioTableBody').innerHTML = html;
                    });
            }, 300); // debounce
        });
    </script>
@endpush
