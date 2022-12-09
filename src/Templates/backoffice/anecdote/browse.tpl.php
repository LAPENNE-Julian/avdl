<div id="backoffice-anecdote" class="container-fluid backoffice">

<?php 
require_once __DIR__ . '/../partials/nav.tpl.php';
require_once __DIR__ . '/../partials/flashMessage.tpl.php';
?>

  <div id="backoffice-anecdote-header">
    <h1 class="backoffice-header">Anecdotes list</h1>

    <div class="text-end">
      <a class="btn btn-dark btn-lg" href="/backoffice/anecdote/add">Add</a>
    </div>
  </div>
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Author</th>
      </tr>
    </thead>

    <tbody>
    <?php foreach($anecdotes as $anecdote): ?>
      <tr>
        <th scope="row"><?= htmlentities($anecdote->getId()) ?></th>
        <td><?= htmlentities($anecdote->getTitle()) ?></td>
        <td><?= htmlentities($anecdote->getWriterId()) ?></td>
        <td>
          <a class="btn btn-outline-primary" href="/backoffice/anecdote/<?= htmlentities($anecdote->getId()) ?>" title="Read" alt="Read">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
          </a>

          <a class="btn btn-outline-warning" href="/backoffice/anecdote/edit/<?= htmlentities($anecdote->getId()) ?>" title="Edit" alt="Edit">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
              <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
              </svg>
          </a>

          <div class="btn-group" role="group">
              <button id="btnGroupDrop1" type="button" class="btn btn-outline-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="Delete" alt="Delete">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg>
              </button>

              <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                  <li><a class="dropdown-item" href="/backoffice/anecdote/delete/<?= htmlentities($anecdote->getId()) ?>">Yes I am sure !</a></li>
                  <li><a class="dropdown-item" href="/backoffice/anecdote">Nope</a></li>
              </ul>
          </div>

        </td>
      </tr>
      
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
