<header class="home-header">
    <nav class="navbar navbar-expand-lg nav-config-bg">
        <a class="navbar-brand navbar-brand-size" href="{{ route('home')}}">Qikify</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Button trigger modal -->
        <?php 
            $url_arr = explode("/", url()->current());
            $project = $url_arr[count($url_arr) - 1];
            if($project == $url_arr[2])
                $project = null;
        ?>
        @if ($project != null)
        <button type="button" class="btn btn-primary border-hidden add-button" data-toggle="modal" data-target="#fileModal" onClick="uploadFile();">
            Add File
        </button>
        @endif

        <!-- Modal -->
        <div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <article class="d-flex justify-content-center">
                        <form class="form-add-project d-flex flex-column justify-content-center" id="fileForm" action="{{ route('upload') }}" enctype="multipart/form-data" method="post">
                            {{ csrf_field() }}
                            <input type="text" value="{{ $project }}" name="path" hidden>
                            <input type="text" name="name" id="fileNameInput" require>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">File input</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file">
                                <button type="submit" class="btn btn-primary border-hidden" style="margin-top: 20px; width: 100%;">Submit</button>
                            </div>
                        </form>
                    </article>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary border-hidden add-button" data-toggle="modal" data-target="#projectModal" onClick="uploadProject();">
            Add Project
        </button>
        <a class="btn btn-primary border-hidden add-button" href="{{ route('admin') }}">
            Chage Password
        </a>
        <!-- Modal -->
        <div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <article class="d-flex justify-content-center">
                        <form class="form-add-project d-flex flex-column justify-content-center " id="projectForm" action="{{ route('project') }}" method="post">
                            {{ csrf_field() }}
                            <input type="text" value="{{ $project }}" name="path" hidden>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Name project</label>
                                <input type="text" class="form-control-file" id="exampleFormControlFile1" name="project" require>
                                <button type="submit" class="btn btn-primary border-hidden" style="margin-top: 20px; width: 100%;">Submit</button>
                            </div>
                        </form>
                    </article>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Admin
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            </ul>

        </div>
    </nav>
</header>