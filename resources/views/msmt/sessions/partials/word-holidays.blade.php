<div class="row" id="jsWordContainer">
  <div class="col-xs-12 col-lg-12">
    <div class="row">
      @php
        $colourCounter = 0;
        $coloumnBreak = 1;
        $colourClass = 'color-'.$colourCounter;
      @endphp
      @foreach($words as $wordGroup)
        <div class="col-xs-6 col-sm-6  <?php echo $respClass;?>">
          @foreach($wordGroup as $wordID=>$word)
            @php 
              $colourClassID = $colourCounter % 10;
              $colourClass = 'color-'.$colourClassID; 
              $combibeID = 10 + $wordID;
            @endphp
            <p class="text-left">
              <span id="jsWord-{{ $wordID }}" class="{{ $colourClass }}">{{$word}}</span> /
              <span id="jsWord-{{ $combibeID }}" class="{{ $colourClass }}">{{$words[1][$combibeID]}}</span>
            </p>
            @if($coloumnBreak % 5 == 0)
              </div> <div class="col-xs-6 col-sm-6  <?php echo $respClass;?>">
            @endif
            @php
              $colourCounter++;
              $coloumnBreak++;
            @endphp
          @endforeach
        </div>
        @break
      @endforeach 
    </div>     
  </div>
</div>  