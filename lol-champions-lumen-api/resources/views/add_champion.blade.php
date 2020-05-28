<form action="usercontroller" method="POST">
    <input type="text" name="id"><br><br>
    <input type="text" name="name"><br><br> 
    <input type="text" name="title"><br><br>
    <input type="text" name="description"><br><br>
    <input type="submit" value="Zatwierdź">
    {{ @csrf_field() }}
</form>