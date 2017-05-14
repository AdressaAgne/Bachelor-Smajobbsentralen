<div id="loading" style="display:none;">
  <label for="file" class="col--center" style="width: 150px;">
      <svg height="150" width="150" class="pie-chart processing" id="svg">
        <circle class="behind"cx="50%" cy="50%" r="40%" />
        <circle class="front" cx="50%" cy="50%" r="40%" data-percent="0" />
      </svg>
  </label>
</div>
<script>
    var loading = {
        loading : $('#loading'),
        show : function() {
            $(this.loading).show();
        },
        hide : function() {
            $(this.loading).hide();
        }    
    }
</script>