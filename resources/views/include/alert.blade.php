@if(Session()->get('status'))                   
<div class="alert alert-success">{{Session()->get('status')}}</div>                            
@endif

@if(Session()->get('error'))                   
<div class="alert alert-success">{{Session()->get('error')}}</div>                            
@endif