<!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Seances</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <button class="btn btn-success" data-toggle="modal" data-target="#ajoutModal">Ajouter</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Lieu</th>
                                            <th>Date</th>
                                            <th>Horaire</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Toulouse</td>
                                            <td>15/07/2021</td>
                                            <td>12H-15H</td>
                                            <td><button class="btn bnt-xs btn-info">Editer</button>|<button class="btn bnt-xs btn-danger">Supprimer</button></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Toulouse</td>
                                            <td>15/07/2021</td>
                                            <td>12H-15H</td>
                                            <td><button class="btn bnt-xs btn-info">Editer</button>|<button class="btn bnt-xs btn-danger">Supprimer</button></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Toulouse</td>
                                            <td>15/07/2021</td>
                                            <td>12H-15H</td>
                                            <td><button class="btn bnt-xs btn-info">Editer</button>|<button class="btn bnt-xs btn-danger">Supprimer</button></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Toulouse</td>
                                            <td>15/07/2021</td>
                                            <td>12H-15H</td>
                                            <td><button class="btn bnt-xs btn-info">Editer</button>|<button class="btn bnt-xs btn-danger">Supprimer</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                       <!-- Ajout Modal-->
    <div class="modal fade" id="ajoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form>
                  <div class="row">
                      <input type="text" class="form-control" placeholder="N°" required>
                      <input type="text" class="form-control" placeholder="Lieu" required>
                      <input type="text" class="form-control" placeholder="Date" required>
                      <input type="text" class="form-control" placeholder="Horaire" required>                  </div>
                </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-success" href="#">Ajouter</button>
                </div>
            </div>
        </div>
    </div>