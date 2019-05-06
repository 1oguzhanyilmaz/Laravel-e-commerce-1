
<?php
$categories = DB::table('categories')->where([['status',1],['parent_id',0]])->get();
?>
<div class="card">
    <div class="card-header">
        Categories
    </div>
    <div class="card-body">
        @foreach($categories as $category)
            <?php
            $sub_categories=DB::table('categories')->select('id','name')->where([['parent_id',$category->id],['status',1]])->get();
            ?>
            <a href="{{route('cats',$category->id)}}" class="p-0 text-dark font-weight-bold">{{$category->name}}</a><br>
            @if(count($sub_categories)>0)
                @foreach($sub_categories as $sub_category)
                    <a href="{{route('cats',$sub_category->id)}}" class="p-0 border-0 ml-2 text-dark"><i class="fa fa-angle-right"> {{ $sub_category->name}}</i></a><br>
                @endforeach
            @endif
        @endforeach
    </div>
</div>
