<div class="container">
  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label for="title">Select Country:</label>
        <select id="country" name="category_id" class="form-control form-control-sm">
          <option value="" selected disabled>Select</option>
          @foreach($countries as $key => $country)
            <option value="{{$key}}"> {{$country}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-sm-4">
        <label for="title">Select State:</label>
        <select name="state" id="state" class="form-control form-control-sm">
        </select>
      </div>
      <div class="col-sm-4">
        <label for="title">Select City:</label>
        <select name="city" id="city" class="form-control form-control-sm">
        </select>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
    $('#country').change(function(){
    var countryID = $(this).val();    
    if(countryID){
        $.ajax({
           type:"GET",
           url:"{{url('get-state-list')}}?country_id="+countryID,
           success:function(res){               
            if(res){
                $("#state").empty();
                $("#state").append('<option>Select</option>');
                $.each(res,function(key,value){
                    $("#state").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#state").empty();
               $("#city").empty();
            }
           }
        });
    }else{
        $("#state").empty();
        $("#city").empty();
    }      
   });
    $('#state').on('change',function(){
    var stateID = $(this).val();    
    if(stateID){
        $.ajax({
           type:"GET",
           url:"{{url('get-city-list')}}?state_id="+stateID,
           success:function(res){               
            if(res){
                $("#city").empty();
                $.each(res,function(key,value){
                    $("#city").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#city").empty();
            }
           }
        });
    }else{
        $("#city").empty();
    }
        
   });
</script>
