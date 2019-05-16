<?php $priceSortArray   = (!empty($_GET['sort'])) ? explode(',', $_GET['sort']) : ''; ?>
<?php $colorArrayFilter = (!empty($_GET['color'])) ? explode(',', $_GET['color']) : ''; ?>
<div class="card">
    <div class="card-header">
        {{$byCate->name}}
    </div>
    <div class="card-body">
        <form action="{{url('products-filter')}}" method="POST" id="filterForm">
            @csrf
            <input type="hidden" name="url" value="{{URL::current()}}">
            <h6>Price</h6>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" name="priceSortFilter[]" class="form-check-input" value="asc"
                    <?=(!empty($priceSortArray) && in_array("asc",$priceSortArray))?' checked':''?>>Ascending
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" name="priceSortFilter[]" class="form-check-input" value="desc"
                    <?=(!empty($priceSortArray) && in_array("desc",$priceSortArray))?' checked':''?>>Descending
                </label>
            </div>
            <hr>
            @if($colorArray)
                <h6>Color</h6>
                @foreach($colorArray as $color)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" name="colorFilter[]" class="form-check-input" value="{{$color}}"
                            <?=(!empty($colorArrayFilter) && in_array($color,$colorArrayFilter))?' checked':''?>>{{$color}}
                        </label>
                    </div>
                @endforeach
                <hr>
            @endif
        </form>
    </div>
</div>
<script>
    // $(document).ready(function(){
    //     $("#filterForm").on("change", "input:checkbox,input:radio", function(){
    //         $("#filterForm").submit();
    //     });
    // });
</script>
