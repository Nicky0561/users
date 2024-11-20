    <div id="wrapper">
            <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
                <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                        <div class="sidebar-brand-text mx-3"><span>RCBE</span></div>
                    </a>
                    <hr class="sidebar-divider my-0">
                    <ul class="navbar-nav text-light" id="accordionSidebar">
                        <li class="nav-item"><a class="nav-link active" href="<?php echo base_url();?>page/index"><i class="fas fa-tachometer-alt"></i><span>Ajout utilisateur</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url();?>page/add_profile"><i class="fas fa-user"></i><span>utilisateurs</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="table.php"><i class="fas fa-table"></i><span>Table</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php"><i class="far fa-user-circle"></i><span>Login</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="register.php"><i class="fas fa-user-circle"></i><span>Register</span></a></li>
                    </ul>
                    <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
                </div>
            </nav>
            
        <div> <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">+ Ajouter</a>

        <!-- Modal pour ajouter un utilisateur -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ajouter un Utilisateur</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <form action="<?php echo base_url();?>User/register_user" method="POST" class="form-group">
                                        <label for="nom">Nom:</label>
                                        <input name="nom" type="text" class="form-control mb-2" required>
                                        <label for="email">E-mail:</label>
                                        <input name="email" type="text" class="form-control mb-2" required>
                                        <label for="role">Rôle:</label>
                                        <select name="role" class="form-control mb-2" required>
                                            <?php foreach ($roles as $role): ?>
                                                <option value="<?php echo $role->role; ?>"><?php echo $role->role; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="submit" class="btn btn-primary" value="Ajouter" >
                                    </form>
                                </div>
                                <div class="col-4"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Affichage de la liste des utilisateurs -->
        <div class="row mt-4">
            <div class="col-12">
                <table class="table"> 
                    <thead>
                        <tr>
                            <th class="bg-primary text-white">ID</th>
                            <th class="bg-primary text-white">Nom</th>
                            <th class="bg-primary text-white">E-mail</th>
                            <th class="bg-primary text-white">Rôle</th>
                            <th class="bg-primary text-white">Statut</th> 
                            <th class="bg-primary text-white"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < count($users); $i++): ?>
                            <tr>
                                <td><?php echo $users[$i]->id; ?></td>
                                <td><?php echo $users[$i]->nom; ?></td>
                                <td><?php echo $users[$i]->email; ?></td>
                                <td><?php echo $users[$i]->role; ?></td> <!-- Affichage du rôle sous forme de texte -->
                                <td><?php echo ucfirst($users[$i]->status); ?></td> 
                                <td>
                                    <?php if ($users[$i]->status == 'actif'): ?>
                                        <a href="<?php echo base_url(); ?>User/suspend_user/<?php echo $users[$i]->id; ?>" class="btn btn-primary">Suspendre</a>
                                    <?php else: ?>
                                        <a href="<?php echo base_url(); ?>User/reactivate_user/<?php echo $users[$i]->id; ?>" class="btn btn-success">Réactiver</a>
                                    <?php endif; ?>
                                    
                                    <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal<?php echo $users[$i]->id; ?>">Modifier</a>
                                    <a href="<?php echo base_url(); ?>User/delete_user/<?php echo $users[$i]->id; ?>" class="btn btn-danger">Supprimer</a>
                                </td>
                            </tr>

                            <!-- Modal pour modifier un utilisateur -->
                            <div class="modal fade" id="myModal<?php echo $users[$i]->id; ?>" tabindex="-1" aria-labelledby="myModalLabel<?php echo $users[$i]->id; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel<?php echo $users[$i]->id; ?>">Modification de <?php echo $users[$i]->nom; ?></h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="<?php echo base_url();?>User/update_user/<?php echo $users[$i]->id; ?>" method="POST" class="form-group">
                                                <label for="nom">Nom:</label>
                                                <input value="<?php echo $users[$i]->nom ;?>" name="nom" type="text" class="form-control mb-2" required>
                                                <label for="email">E-mail:</label>
                                                <input value="<?php echo $users[$i]->email ;?>" name="email" type="text" class="form-control mb-2" required>
                                                <label for="role">Rôle:</label>
                                                <select name="role" class="form-control mb-2" required>
                                                    <?php foreach ($roles as $role): ?>
                                                        <option value="<?php echo $role->role; ?>" 
                                                            <?php echo ($role->role == $users[$i]->role) ? 'selected' : ''; ?>>
                                                            <?php echo $role->role; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <input type="submit" class="btn btn-primary" value="Enregistrer">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
