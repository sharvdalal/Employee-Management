

<form action="" method="post">
    <label for="attendance">Choose Date</label>
    <input class="" type="date" id="attendance" name="attendance">
    <button type="submit" id="datebutton">Submit</button>
</form>





<script>
    const today = new Date();
    const dateSplit = today.toISOString().split('T')[0];
    document.getElementById('attendance').value = dateSplit;

</script>