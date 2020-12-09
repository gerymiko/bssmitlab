<div class="mdl-card__supporting-text">
	<h4 class="text-white text-center">KPI DASHBOARD <?=date("Y")?></h4>
</div>
<div class="mdl-card__supporting-text" style="padding-top: 10px;padding-bottom: 10px;">
	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" id="yearly-tab" data-toggle="tab" href="#yearly" role="tab" aria-controls="yearly" aria-selected="true">YEARLY</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="monthly-tab" data-toggle="tab" href="#monthly" role="tab" aria-controls="monthly" aria-selected="false">MONTHLY</a>
		</li>
	</ul>
	<div class="tab-content no-padding" id="myTabContent">
		<div class="tab-pane fade show active" id="yearly" role="tabpanel" aria-labelledby="yearly-tab">
			<div class="mdl-card__supporting-text" style="padding-top: 20px;padding-bottom: 10px;">
				<p class="text-white no-margin-top-bottom">YEARLY BASE</p>
			</div>
			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
			    <div class="mdl-card mdl-shadow--2dp">
			        <div class="mdl-card__title" style="padding-top: 10px;padding-bottom: 10px;background: #F2DCDB;">
			            <h5 class="mdl-card__title-text">TOTAL PERFORMANCE (YEAR TO DATE)</h5>
			        </div>
			        <div class="mdl-card__supporting-text">
						<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
							<h5 class="text-center">LEVEL : PROJECT</h5>
						</div>
			        </div>
			    </div>
			</div>
			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
			    <div class="mdl-card mdl-shadow--2dp">
			        <div class="mdl-card__title" style="padding-top: 10px;padding-bottom: 10px;background: #F2DCDB;">
			            <h5 class="mdl-card__title-text">FINANCIAL PERSPECTIVE</h5>
			        </div>
			        <div class="mdl-card__supporting-text">
			        	<div class="mdl-grid ui-tables">
			        		<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
			        			<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Cost</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($cost_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Revenue & Produksi</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($rev_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
			        	</div>
			        </div>
			    </div>
			</div>
			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
			    <div class="mdl-card mdl-shadow--2dp">
			        <div class="mdl-card__title" style="padding-top: 10px;padding-bottom: 10px;background: #F2DCDB;">
			            <h5 class="mdl-card__title-text">CUSTOMER PERSPECTIVE</h5>
			        </div>
			        <div class="mdl-card__supporting-text">
			        	<div class="mdl-grid ui-tables">
			        		<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
			        			<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Coal</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($coal_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">OB Removal</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($ob_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">GMP</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($gmp_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">CSI</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($csi_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
			        	</div>
			        </div>
			    </div>
			</div>
			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
			    <div class="mdl-card mdl-shadow--2dp">
			        <div class="mdl-card__title" style="padding-top: 10px;padding-bottom: 10px;background: #F2DCDB;">
			            <h5 class="mdl-card__title-text">INTERNAL PROCESS PERSPECTIVE</h5>
			        </div>
			        <div class="mdl-card__supporting-text">
			        	<div class="mdl-grid ui-tables">
			        		<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
			        			<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">PA Unit</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($pa_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Produktifitas MP</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($pmp_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Productifity Alat</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($paa_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">UA</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($ua_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Safety Performance</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($safety_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">CSR</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($csr_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
			        	</div>
			        </div>
			    </div>
			</div>
			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
			    <div class="mdl-card mdl-shadow--2dp">
			        <div class="mdl-card__title" style="padding-top: 10px;padding-bottom: 10px;background: #F2DCDB;">
			            <h5 class="mdl-card__title-text">LEARNING AND GROWTH</h5>
			        </div>
			        <div class="mdl-card__supporting-text">
			        	<div class="mdl-grid ui-tables">
			        		<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
			        			<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Index Kepuasan Karyawan</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($index_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">System Development</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($dev_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
			        	</div>
			        </div>
			    </div>
			</div>
			<div class="mdl-card__supporting-text" style="padding-top: 10px;padding-bottom: 10px;">
				<p class="text-white no-margin-top-bottom">YEARLY RUNNING</p>
			</div>
			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
			    <div class="mdl-card mdl-shadow--2dp">
			        <div class="mdl-card__title" style="padding-top: 10px;padding-bottom: 10px;background: #F2DCDB;">
			            <h5 class="mdl-card__title-text">TOTAL PERFORMANCE (MONTH TO DATE)</h5>
			        </div>
			        <div class="mdl-card__supporting-text">
						<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
							<h5 class="text-center">LEVEL : PROJECT</h5>
						</div>
			        </div>
			    </div>
			</div>
			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
			    <div class="mdl-card mdl-shadow--2dp">
			        <div class="mdl-card__title" style="padding-top: 10px;padding-bottom: 10px;background: #F2DCDB;">
			            <h5 class="mdl-card__title-text">FINANCIAL PERSPECTIVE</h5>
			        </div>
			        <div class="mdl-card__supporting-text">
			        	<div class="mdl-grid ui-tables">
			        		<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
			        			<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Cost</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($cost_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Revenue & Produksi</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($rev_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
			        	</div>
			        </div>
			    </div>
			</div>
			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
			    <div class="mdl-card mdl-shadow--2dp">
			        <div class="mdl-card__title" style="padding-top: 10px;padding-bottom: 10px;background: #F2DCDB;">
			            <h5 class="mdl-card__title-text">CUSTOMER PERSPECTIVE</h5>
			        </div>
			        <div class="mdl-card__supporting-text">
			        	<div class="mdl-grid ui-tables">
			        		<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
			        			<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Coal</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($coal_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">OB Removal</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($ob_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">GMP</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($gmp_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">CSI</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($csi_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
			        	</div>
			        </div>
			    </div>
			</div>
			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
			    <div class="mdl-card mdl-shadow--2dp">
			        <div class="mdl-card__title" style="padding-top: 10px;padding-bottom: 10px;background: #F2DCDB;">
			            <h5 class="mdl-card__title-text">INTERNAL PROCESS PERSPECTIVE</h5>
			        </div>
			        <div class="mdl-card__supporting-text">
			        	<div class="mdl-grid ui-tables">
			        		<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
			        			<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">PA Unit</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($pa_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Produktifitas MP</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($pmp_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Productifity Alat</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($paa_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">UA</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($ua_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Safety Performance</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($safety_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">CSR</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($csr_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
			        	</div>
			        </div>
			    </div>
			</div>
			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
			    <div class="mdl-card mdl-shadow--2dp">
			        <div class="mdl-card__title" style="padding-top: 10px;padding-bottom: 10px;background: #F2DCDB;">
			            <h5 class="mdl-card__title-text">LEARNING AND GROWTH</h5>
			        </div>
			        <div class="mdl-card__supporting-text">
			        	<div class="mdl-grid ui-tables">
			        		<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
			        			<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Index Kepuasan Karyawan</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($index_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">System Development</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($dev_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
			        	</div>
			        </div>
			    </div>
			</div>
		</div>
		<div class="tab-pane fade" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
			<div class="mdl-card__supporting-text" style="padding-top: 20px;padding-bottom: 10px;">
				<form id="form-monthly" action="#" method="post">
					<select class="form-control col-md-4" name="monthly" id="monthly" style="border-radius: 0;">
						<option value="">Select Month</option>
						<?php
							$month = array (1 => 'Januari',
								'Februari',
								'Maret',
								'April',
								'Mei',
								'Juni',
								'Juli',
								'Agustus',
								'September',
								'Oktober',
								'November',
								'Desember'
							);
							$bulan = array (1 => 'Jan',
								'Feb',
								'Mar',
								'Apr',
								'Mei',
								'Jun',
								'Jul',
								'Agt',
								'Sep',
								'Okt',
								'Nov',
								'Des'
							);
							$a = 12;
							for ($i=1; $i<=$a; $i++) {
								echo '<option value="'.$bulan[$i].'">'.$month[$i].'</option>';
							}
						?>
					</select>
				</form>
			</div>

			<div class="mdl-card__supporting-text" style="padding-top: 20px;padding-bottom: 10px;">
				<p class="text-white no-margin-top-bottom">MONTHLY BASE</p>
			</div>
			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
			    <div class="mdl-card mdl-shadow--2dp">
			        <div class="mdl-card__title" style="padding-top: 10px;padding-bottom: 10px;background: #F2DCDB;">
			            <h5 class="mdl-card__title-text">FINANCIAL PERSPECTIVE</h5>
			        </div>
			        <div class="mdl-card__supporting-text">
			        	<div class="mdl-grid ui-tables">
			        		<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
			        			<table class="mdl-data-table mdl-js-data-table" id="table_cost_base">
				                    <p class="mdl-data-table__cell--non-numeric">Cost</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Revenue & Produksi</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($rev_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">EBITDA</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($rev_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
			        	</div>
			        </div>
			    </div>
			</div>
			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
			    <div class="mdl-card mdl-shadow--2dp">
			        <div class="mdl-card__title" style="padding-top: 10px;padding-bottom: 10px;background: #F2DCDB;">
			            <h5 class="mdl-card__title-text">CUSTOMER PERSPECTIVE</h5>
			        </div>
			        <div class="mdl-card__supporting-text">
			        	<div class="mdl-grid ui-tables">
			        		<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
			        			<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Coal</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($coal_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">OB Removal</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($ob_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">GMP</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($gmp_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">CSI</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($csi_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
			        	</div>
			        </div>
			    </div>
			</div>
			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
			    <div class="mdl-card mdl-shadow--2dp">
			        <div class="mdl-card__title" style="padding-top: 10px;padding-bottom: 10px;background: #F2DCDB;">
			            <h5 class="mdl-card__title-text">INTERNAL PROCESS PERSPECTIVE</h5>
			        </div>
			        <div class="mdl-card__supporting-text">
			        	<div class="mdl-grid ui-tables">
			        		<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
			        			<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">PA Unit</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($pa_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Produktifitas MP</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($pmp_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Productifity Alat</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($paa_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">UA</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($ua_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Safety Performance</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($safety_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">CSR</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($csr_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
			        	</div>
			        </div>
			    </div>
			</div>
			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
			    <div class="mdl-card mdl-shadow--2dp">
			        <div class="mdl-card__title" style="padding-top: 10px;padding-bottom: 10px;background: #F2DCDB;">
			            <h5 class="mdl-card__title-text">LEARNING AND GROWTH</h5>
			        </div>
			        <div class="mdl-card__supporting-text">
			        	<div class="mdl-grid ui-tables">
			        		<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
			        			<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Index Kepuasan Karyawan</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($index_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">System Development</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($dev_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
			        	</div>
			        </div>
			    </div>
			</div>
			<div class="mdl-card__supporting-text" style="padding-top: 10px;padding-bottom: 10px;">
				<p class="text-white no-margin-top-bottom">MONTHLY RUNNING</p>
			</div>
			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
			    <div class="mdl-card mdl-shadow--2dp">
			        <div class="mdl-card__title" style="padding-top: 10px;padding-bottom: 10px;background: #F2DCDB;">
			            <h5 class="mdl-card__title-text">FINANCIAL PERSPECTIVE</h5>
			        </div>
			        <div class="mdl-card__supporting-text">
			        	<div class="mdl-grid ui-tables">
			        		<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
			        			<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Cost</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($cost_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Revenue & Produksi</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($rev_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">EBITDA</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($rev_base as $row) {
				                        			$Plan_Base = ($row->Plan_Base == null) ? '-' : $row->Plan_Base;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Base = ($row->Index_Base == null) ? '-' : $row->Index_Base;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Base.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
			        	</div>
			        </div>
			    </div>
			</div>
			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
			    <div class="mdl-card mdl-shadow--2dp">
			        <div class="mdl-card__title" style="padding-top: 10px;padding-bottom: 10px;background: #F2DCDB;">
			            <h5 class="mdl-card__title-text">CUSTOMER PERSPECTIVE</h5>
			        </div>
			        <div class="mdl-card__supporting-text">
			        	<div class="mdl-grid ui-tables">
			        		<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
			        			<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Coal</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($coal_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">OB Removal</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($ob_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">GMP</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($gmp_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">CSI</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($csi_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
			        	</div>
			        </div>
			    </div>
			</div>
			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
			    <div class="mdl-card mdl-shadow--2dp">
			        <div class="mdl-card__title" style="padding-top: 10px;padding-bottom: 10px;background: #F2DCDB;">
			            <h5 class="mdl-card__title-text">INTERNAL PROCESS PERSPECTIVE</h5>
			        </div>
			        <div class="mdl-card__supporting-text">
			        	<div class="mdl-grid ui-tables">
			        		<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
			        			<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">PA Unit</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($pa_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Produktifitas MP</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($pmp_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Productifity Alat</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($paa_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">UA</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($ua_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Safety Performance</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($safety_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">CSR</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($csr_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
			        	</div>
			        </div>
			    </div>
			</div>
			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
			    <div class="mdl-card mdl-shadow--2dp">
			        <div class="mdl-card__title" style="padding-top: 10px;padding-bottom: 10px;background: #F2DCDB;">
			            <h5 class="mdl-card__title-text">LEARNING AND GROWTH</h5>
			        </div>
			        <div class="mdl-card__supporting-text">
			        	<div class="mdl-grid ui-tables">
			        		<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
			        			<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">Index Kepuasan Karyawan</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($index_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
								<table class="mdl-data-table mdl-js-data-table">
				                    <p class="mdl-data-table__cell--non-numeric">System Development</p>
				                    <thead>
				                        <tr>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Plan</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Actual</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center bg-blue">Index</th>
				                            <th class="mdl-data-table__cell--non-numeric text-center">Weight</th>
				                        </tr>
				                    </thead>
				                    <tbody class="bg-dark-gray">
				                        <tr>
				                        	<?php
				                        		foreach ($dev_Running as $row) {
				                        			$Plan_Running = ($row->Plan_Running == null) ? '-' : $row->Plan_Running;
				                        			$Actual = ($row->Actual == null) ? '-' : $row->Actual;
				                        			$Index_Running = ($row->Index_Running == null) ? '-' : $row->Index_Running;
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Plan_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$Actual.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center bg-blue">'.$Index_Running.'</td>';
				                        			echo '<td class="mdl-data-table__cell--non-numeric text-center">'.$row->weight.'%</td>';
				                        		}
				                        	?>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
			        	</div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	.nav-tabs .nav-link {
		border-top-left-radius: 0;
		border-top-right-radius: 0;
	}
	.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
		background-color: #4169E1;
		color: #fff;
	}
	.nav-tabs {
		border-bottom: none;
		margin-bottom: 2px;
	}
	.tab-content {
		background: #444444; 
	}
	.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
		border: 1px solid #4169E1;
	}
	h5.mdl-card__title-text { font-size: 14px; }
	a.nav-link { font-size: 12px; }
</style>
<script type="text/javascript">
	$(document).ready(function (){
		$('#link_dashboard').addClass('mdl-navigation__link--current');
		if (location.hash) {
			$("a[href='" + location.hash + "']").tab("show");
		}
		$(document.body).on("click", "a[data-toggle='tab']", function(event) {
			location.hash = this.getAttribute("href");
		});
		$(window).on("popstate", function() {
			var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
			$("a[href='" + anchor + "']").tab("show");
		});

		$.ajax({
			url: "<?=site_url('table/cost_base/').$accessRights->site?>",
		    type: "POST",
		    data: {
		    	'strategy_obj': 'COST',
		    	'bulan': 'mei'
		    },
		    dataType: 'JSON',
		    success: function (result) {
		        var i = 0;
    			$.each(result, function(index, value) {
    				var html = ''; 
    				$.each(value, function(key, val){
    					html+='<td class="mdl-data-table__cell--non-numeric text-center">'+val+'</td>';
				    });
				    $('#table_cost_base tbody #'+i).append(html);
				    i++;
				});
		    }
		});

	});
</script>