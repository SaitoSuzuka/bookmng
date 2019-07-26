@extends('layouts.app')

@section('content')
<div class="panel-body"><!-- url('book')はweb.appの当てはまるところに飛ぶ -->
	@include('common.errors')<!-- commonフォルダのerrors.blead.phpを挿入する -->
	<form action="{{ url('books')}}" method = "post" class="form-horizontal"> <!-- submit するとここが動く -->
	<!-- web.phpの'book'に飛ぶ -->
		{{ csrf_field() }} <!-- サーバー攻撃から守るためのおまじないの文 -->

		<div class="form-group"><!-- 部品用のform-group -->
			<div class="col-sm-6"><!-- ブラウザ画面は１２分割されていてそのうちの６ -->
				<!-- label for=""　と input id=""が紐づく
				ブラウザではテキストボックスか、ラベルをクリックすると
				自動的にテキストボックスにカーソルがでる -->
				<label for="book" class="col-sm-3 control-label">Book</label> <!-- old()の中身はinputのnameと一致  -->
				<input type="text" name="item_name" id="book" class="form-control" value="{{ old('item_name')}}">
			</div>
			<div class="col-sm-6">
				<label for="amount" class="col-sm-3 control-label">金額</label>
				<input type="text" name="item_amount" id="amount" class="form-control" value="{{ old('item_amount')}}">
			</div>
			<div class="col-sm-6">
				<label for="number" class="col-sm-3 control-label">数</label>
				<input type="text" name="item_number" id="number" class="form-control" value="{{ old('item_number')}}">
			</div>
			<div class="col-sm-6">
				<label for="published" class="col-sm-3 control-label">公開日</label>
				<input type="text" name="published" id="published" class="form-control" value="{{ old('published')}}">
			</div>
		</div><!-- 部品用のform-groupの終わり -->

		<div class="form-grop"><!-- ボタン用のform-group -->
			<div class="col-sm-offset-2 col-sm-6">
			<button type="submit" class="btn btn-default">
				<!-- iタグはアイコン -->
				<i class="glyphicon glyphicon-plus" aria-hidden="true"></i>登録
			</button>
			</div>
		</div><!-- ボタン用form-groupの終わり -->

	</form>
</div>

<!-- 本の一覧を表示する -->
	@if(count($books)) <!-- $books(model)のなかにデータが入っていたら処理が通る -->
		<div class="panel panel-default">
			<div class="panel-heading">
				現在の本
			</div>
			<div class="panel-body">
				<table class="table table-striped task-table">
					<thead>
						<th>本</th>
						<th></th>
					</thead>
					<!--foreach( booksからbookにいれている) 拡張for文と同じ*ただし（）の書き方が逆 -->
					@foreach($books as $book)
						<tr>
							<td class="table-text">
								<div>{{ $book -> item_name }}</div>
							</td>
							<td>
								<!-- ↓URLの末尾にbookidをくっつける -->
								<form action="{{ url('bookedit/' . $book->id)}}" method="post">
									{{ csrf_field() }}
									<button type="submit" class="btn btn-primary">
										<i class="glyphicon glyphicon-pencil"></i>更新
									</button>
								</form>
							</td>
							<td>
								<form action="{{ 'book/' . $book->id }}" method="post">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<button type="submit" class="btn btn-danger">
										<i class="glyphicon glphicon-trash"></i>削除
									</button>
								</form>
							</td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>
	@endif
@endsection