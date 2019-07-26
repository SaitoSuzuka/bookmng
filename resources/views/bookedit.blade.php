@extends('layouts.app')<!-- ()は親ページの場所指定 -->

@section('content')<!-- 入るのは()の位置でsectionの中身が入る -->
	<div class="row">
		<div class="col-md-12">
			@include('common.errors') <!-- チェック commonフォルダの中のerrorsファイル-->
			<form action="{{ url('/book/update') }}" method="post">
				{{ csrf_field() }}
				<!-- formタグ内に hiddenで bookのidを持たせる。 -->
				<input type="hidden" name="id" value="{{ $book->id }}">
				<div class="form-group">
					<label for="item_name">タイトル</label>
					<input type="text" id="item_name" name="item_name" class="form-control" value="{{ $book->item_name }}">
				</div>
				<div class="form_group">
					<label for="item_number">数</label>
					<input type="text" id="item_number" name="item_number" class="form-control" value="{{ $book->item_number }}">
				</div>
				<div class="form-group">
					<label for="item_amount">金額</label>
					<input type="text" id="item_amount" name="item_amount" class="form-control" value="{{ $book->item_amount }}">
				</div>
				<div class="form-group">
					<label for="published">公開日</label>
					<input type="text" id="published" name="published" class="form-control" value="{{ $book->published }}">
				</div>
				<div class="well well-sm">
					<button type="submit" class="btn btn-primary">Save</button>
					<a href="{{ url('/') }}" class="btn btn-link pull-right"><!-- aタグだとget送信 web.phpのget('/')と統一 -->
						<i class="glyphicon glyphicon-backward"></i>Back
					</a>
				</div>
			</form>
		</div>
	</div>
@endsection