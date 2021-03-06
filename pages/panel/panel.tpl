{include file='header.tpl'}
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    {include file='navbar.tpl'}
    {include file='sidebar.tpl'}

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">ParticlesJS</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{$PANEL_INDEX}">{$DASHBOARD}</a></li>
                            <li class="breadcrumb-item active">ParticlesJS</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        {if (isset($CORRECTO))}
                            <div class="alert alert-success">
                            {foreach from=$CORRECTO item=item}
                                {$item}
                            {/foreach}
                            </div>
                        {/if}
                        {if (isset($ERROR))}
                            <div class="alert alert-danger">
                            {foreach from=$ERROR item=item}
                                {$item}
                            {/foreach}
                            </div>
                        {/if}
                        <br>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="Tipo">Tipo </label>
                                <select name="Tipo" class="form-control" id="Tipo">
                                    <option value="circle" {if ($VALUE.shape.type == 'circle')} selected {/if} >Circulo</option>
                                    <option value="image" {if ($VALUE.shape.type == 'image')} selected {/if}>Imagen</option>
                                </select>
							</div>
                            <div class="form-group">
                                <label for="Enlazado">Enlazado? </label>
                                <select name="Enlazado" class="form-control" id="Enlazado">
                                    <option value="true" {if ($VALUE.line_linked.enable == true)} selected {/if}>Yes</option>
                                    <option value="false" {if ($VALUE.line_linked.enable == false)} selected {/if}>No</option>
                                </select>
							</div>
                            <div class="form-group">
                                <label for="Movimiento">Movimiento? </label>
                                <select name="Movimiento" class="form-control" id="Movimiento">
                                    <option value="true" {if ($VALUE.move.enable == true)} selected {/if}>Yes</option>
                                    <option value="false" {if ($VALUE.move.enable == false)} selected {/if}>No</option>
                                </select>
                            </div>
                            
                            {if ($VALUE.shape.type == 'image')}
                                <div class="form-group">
                                    <label for="Imagen">Imagen </label>
                                    <input type="text" id="Imagen" name="Imagen" class="form-control" value="{$VALUE.shape.image.src}">
                                </div>
                                <div class="form-group">
                                    <label for="ALYAN">Altura y anchura </label>
                                    <input type="text" id="AL" name="AL" class="form-control" value="{$VALUE.shape.image.width}">
                                    <input type="text" id="AN" name="AN" class="form-control" value="{$VALUE.shape.image.height}">
                                </div>
                                
                                <div class="form-group d-none">
                                    <label for="Color">Color </label>
                                    <input type="text" id="Color" name="Color" class="form-control" value="0">
                                </div>
                                <div class="form-group d-none">
                                    <label for="Color">Tamano </label>
                                    <input type="text" id="Tamano" name="Tamano" class="form-control" value="0">
                                </div>
                            {else}
                                <div class="form-group d-none">
                                    <label for="Imagen">Imagen </label>
                                    <input type="text" id="Imagen" name="Imagen" class="form-control" value="null">
                                </div>
                                <div class="form-group  d-none">
                                    <label for="ALYAN">Altura y anchura </label>
                                    <input type="text" id="AL" name="AL" class="form-control" value="0">
                                    <input type="text" id="AN" name="AN" class="form-control" value="0">
                                </div>
                                <div class="form-group">
                                    <label for="Color">Color </label>
                                    <input type="text" id="Color" name="Color" class="form-control" value="{$VALUE.color.value}">
                                </div>
                                <div class="form-group">
                                    <label for="Color">Tamano </label>
                                    <input type="text" id="Tamano" name="Tamano" class="form-control" value="{$VALUE.size.value}">
                                </div>
                            {/if}

							<div class="form-group">
								<label for="Cantidad">Cantidad</label>
								<input type="text" id="Cantidad" placeholder="Cantidad" name="Cantidad" class="form-control" value="{$VALUE.number.value}">
							</div>
							<div class="form-group">
								<label for="Dencidad">Dencidad</label>
								<input type="text" id="Dencidad" placeholder="Dencidad" name="Dencidad" class="form-control" value="{$VALUE.number.density.value_area}">
							</div>
                            
                            
							<div class="form-group">
								<label for="CE">Color de enlaze</label>
								<input type="text" id="CE" placeholder="CE" name="CE" class="form-control" value="{$VALUE.line_linked.color}">
							</div>
							<div class="form-group">
								<label for="DE">Distancia de enlaze</label>
								<input type="text" id="DE" placeholder="DE" name="DE" class="form-control" value="{$VALUE.line_linked.distance}">
							</div>
							<div class="form-group">
								<label for="OE">Opacidad de enlaze</label>
								<input type="text" id="OE" placeholder="OE" name="OE" class="form-control" value="{$VALUE.line_linked.opacity}">
                            </div>
							<div class="form-group">
								<label for="WE">Anchura de enlaze</label>
								<input type="text" id="WE" placeholder="WE" name="WE" class="form-control" value="{$VALUE.line_linked.width}">
                            </div>
                            



							<div class="form-group">
								<label for="DV">Velocidad De Movimiento</label>
								<input type="text" id="DV" placeholder="DV" name="DV" class="form-control" value="{$VALUE.move.speed}">
                            </div>
                            <br>
                            <br>
                            
                            <div class="form-group">
                                <label for="DMovimiento">Direccion de movimiento? </label>
                                <select name="DMovimiento" class="form-control" id="DMovimiento">
                                    <option value="top" {if ($VALUE.move.direction == 'top')} selected {/if}>Arriba</option>
                                    <option value="right"{if ($VALUE.move.direction == 'right')} selected {/if} >Right</option>
                                    <option value="left" {if ($VALUE.move.direction == 'left')} selected {/if}>Left</option>
                                    <option value="button" {if ($VALUE.move.direction == 'button')} selected {/if}>Abajo</option>
                                    <option value="none" {if ($VALUE.move.direction == 'none')} selected {/if}>Random</option>
                                </select>
                            </div>
                            
							<div class="form-group">
								<label for="Altura">Altura</label>
								<input type="text" id="Altura" placeholder="Altura" name="Altura" class="form-control" value="{$VALUE.Altura}">
                            </div>
                            

                            <div class="form-group">
                                <input type="hidden" name="token" value="{$TOKEN}">
                                <input type="submit" class="btn btn-primary" value="{$SUBMIT}">
                            </div>
						</form>
                        <hr />
                        <p>Your template default is: {$Template_Default}</p>
                        <a class="btn btn-primary" href="{$INSTALL_PLANTILLA}">Install in template</a>
                    </div>
                </div>
                    <!-- Spacing -->
                <div style="height:1rem;">
                    <small>
                        ParticlesJS Powered by CubericoStudios
                    </small>
                </div>

                </div>
        </section>
    </div>

    {include file='footer.tpl'}

</div>
<!-- ./wrapper -->

{include file='scripts.tpl'}

</body>
</html>