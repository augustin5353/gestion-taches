<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}


#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>

<div>
  <h1>Liste de vos taches</h1>
</div>

<table id="customers">
  <tr>
    <th>Numéro</th>
    <th>Nom de la tache</th>
    <th>Detail</th>
    <th>Niveau</th>
    <th>Date debut</th>
    <th>Date fin</th>
  </tr>

  @forelse ($taches as $tache)
    <tr>

      <td>{{ $tache->id }}</td>
      <td>{{ $tache->name }}</td>
      <td>{{ $tache->description }}</td>
      <td>{{ $tache->level }}</td>
      <td>{{ $tache->beginned_at }}</td>
      <td>{{ $tache->finished_at }}</td>

    </tr>
  @empty
      
  @endforelse

  
  
</table>

</body>
</html>


