<div class="row" id="jsWordContainer">
  <div class="col-xs-offset-2 col-xs-5 col-lg-10">
    <div class="row">
      @foreach($words as $wordGroup)
        <div class="col-xs-6 col-sm-6  <?php echo $respClass;?>">
          @foreach($wordGroup as $wordID=>$word)
            <p id="jsWord-{{ $wordID }}" class="text-left">{{$word}}</p>
          @endforeach
        </div>
      @endforeach 
    </div>
  </div>
</div>