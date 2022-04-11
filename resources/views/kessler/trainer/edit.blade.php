@extends('kessler.layouts.master')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Trainer</h3></div>
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form method="post" action="{{ route('trainer.update', $trainer->id) }}">
              @method('PATCH') 
              @csrf
              <div class="form-group">
                <label class="small mb-1" for="name">Update name</label>
                <input type="text" class="form-control py-4" name="name" id="name" placeholder="Update name" value="{{$trainer->name}}">
              </div>
              <div class="form-group">
                <label class="small mb-1" for="email">Update email</label>
                <input type="text" class="form-control py-4" name="email" id="email" placeholder="Update email" value="{{$trainer->email}}">
              </div>   
              <div class="form-group">
                <label class="small mb-1" for="email">Update category</label>
                <select class="form-control select2" id="jsCategory" name="category[]" multiple="multiple">
                  <!-- <option value= '' >Select Categories</option> -->
                  @foreach($categories as $id=>$name)
                    <option value="{{ $id }}" selected="selected">{{ $name }}</option>
                  @endforeach;
                </select>
              </div>        
            @if(is_array($story[0]) && count($story[0])>0)
              <div class="form-group " id="jsStory">
              <label class="small mb-1" for="session_number">Story Sessions</label>
              <select class="form-control select2 category" id="story_session" name="story[]"  multiple="multiple" placeholder="Select Story Session" >
                <option value='' >Story Sessions</option>
                
                @foreach($story[0] as $story)
                  <option value="{{ $story }}" selected="selected">{{ $story }}</option>
                @endforeach;
              
              </select>
              </div>
            @endif 
            @if(is_array($contextual[0]) && count($contextual[0]) > 0)
            <div class="form-group" id="jsContext">
              <label class="small mb-1" for="context_session">Contextual Sessions</label>
              <select class="form-control select2 category" id="context_session" name="contextual[]" multiple="multiple" placeholder="Select Contextual Session">
                <option value='' >Contextual Sessions</option>
                
                @foreach($contextual[0] as $contextual)
                  <option value="{{ $contextual }}" selected="selected">{{ $contextual }}</option>
                @endforeach;
              
              </select>
             </div>
            @endif
            @if(is_array($general[0]) && count($general[0]) > 0)
            <div class="form-group" id="jsGeneral">
              <label class="small mb-1" for="general_session">General Sessions</label>
              <select class="form-control select2 category" id="general_session" name="general[]" multiple="multiple" placeholder="Select General Session">
                <option value='' >General Sessions</option>
                
                @foreach($general[0] as $general)
                  <option value="{{ $general }}" selected="selected">{{ $general }}</option>
                @endforeach;
              
              </select>
             </div>
            @endif
            @if(is_array($boosterSes) && count($boosterSes) > 0)
            <div class="form-group" id="jsBooster">
               <label class="small mb-1" for="booster">Booster Sessions</label>
              <select class="form-control select2" id="booster" name="booster[]" multiple="multiple" placeholder="Select Booster Session">
                <option value= '' >Booster Sessions</option>
                @foreach($boosterSes as $id=>$category)
                  <option value="{{ $id }}" selected="selected">{{ $category}}</option>
                @endforeach;
              </select>
            </div>
            @endif
              <div class="form-group d-flex align-items-center float-right mt-4 mb-0">
                <button type="submit" class="btn btn-primary"><i class="fas fa-sync">&nbsp;</i> Update</button>
                <a href="{{ url('/trainer')}}" class="ml-2 btn btn-danger" role="button"><i class="fas fa-times">&nbsp;</i> Cancel</a>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection