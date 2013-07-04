
$(document).ready( function() {
  $('.autosuggest').keyup( function() {

      var search_term = $(this).attr('value');  // may need modification
      $.post('search.php', { search_term: search_term }, function(data){  // function(data) : call back function, data variable will have return value
         // Whatver is returned from "search.php" is in variable "data"
           // alert(data);
           
           $('.result').html(data);    // fill elements in tags using class .result
           
           $('.result li').click(function(){                         // When we will have a Drop down Menu, then selecting choice will appear in search field
                   var result_value = $(this).text();
                   $('.autosuggest').attr('value', result_value);
                   $('.result').html('');

             });


     });  // $.post....


  });
 });
 
 
 /*
 
 $(document).ready( function() {
  $('.autosuggest').keyup( function() {

      var search_term = $(this).attr('value');  // may need modification
      $.post('search.php', { search_term: search_term }, function(data){  // function(data) : call back function, data variable will have return value
         // Whatver is returned from "search.php" is in variable "data"
           // alert(data);
           
           $('.result').html(data);    // fill elements in tags using class .result
           
           $('.result li').click(function(){
                   var result_value = $(this).text();
                   $('.autosuggest').attr('value', result_value);
                   $('.result').html('');

             });


     });  // $.post....


  });
 });
 
 
 */