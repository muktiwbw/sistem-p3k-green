<div class="form-element">
    <div class="col-md-12 padding-0">
        <div class="col-md-8">
            <div class="panel form-element-padding">
                <div class="panel-heading">
                    <h4>{{ $title }}</h4>
                </div>
                <div class="panel-body">
                    <form action="{{ $action }}" method="post">
                        {{ $form_content }}
                        @csrf
                    </form>
                    {{ $link }}
                </div>
            </div>
        </div>
    </div>
</div>