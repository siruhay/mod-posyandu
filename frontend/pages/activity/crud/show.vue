<template>
	<form-show with-helpdesk>
		<template v-slot:default="{ record }">
			<v-card-text>
				<v-stepper alt-labels elevation="0">
					<v-stepper-header>
						<v-stepper-item
							title="Input Data"
							subtitle="Kader Posyandu"
							value="1"
						></v-stepper-item>

						<v-divider></v-divider>

						<v-stepper-item
							title="Verifikasi"
							subtitle="Bersama Pemerintah Desa"
							value="2"
						></v-stepper-item>

						<v-divider></v-divider>

						<v-stepper-item
							title="Kirim ke Desa"
							subtitle="Kader Posyandu"
							value="3"
						></v-stepper-item>

						<v-divider></v-divider>

						<v-stepper-item
							title="Intervensi"
							subtitle="Pemdes / OPD Terkait"
							value="4"
						></v-stepper-item>
					</v-stepper-header>
				</v-stepper>

				<div class="text-overline">BIDANG SPM</div>

				<v-item-group selected-class="bg-primary">
					<v-row dense>
						<v-col>
							<v-item v-slot="{ selectedClass, toggle }">
								<v-card
									:class="[
										'd-flex flex-column justify-center align-center',
										selectedClass,
									]"
									height="100"
									dark
									@click="toggle"
								>
									<div class="text-center">
										<v-icon class="mb-2" size="x-large"
											>school</v-icon
										>
										<div
											class="flex-grow-1 text-caption text-center"
											style="line-height: 1; height: 24px"
										>
											Pendidikan
										</div>
									</div>
								</v-card>
							</v-item>
						</v-col>

						<v-col>
							<v-item v-slot="{ selectedClass, toggle }">
								<v-card
									:class="[
										'd-flex flex-column justify-center align-center',
										selectedClass,
									]"
									height="100"
									dark
									@click="toggle"
								>
									<div class="text-center">
										<v-icon class="mb-2" size="x-large"
											>medical_services</v-icon
										>
										<div
											class="flex-grow-1 text-caption text-center"
											style="line-height: 1; height: 24px"
										>
											Kesehatan
										</div>
									</div>
								</v-card>
							</v-item>
						</v-col>

						<v-col>
							<v-item v-slot="{ selectedClass, toggle }">
								<v-card
									:class="[
										'd-flex flex-column justify-center align-center',
										selectedClass,
									]"
									height="100"
									dark
									@click="toggle"
								>
									<div class="text-center">
										<v-icon class="mb-2" size="x-large"
											>garden_cart</v-icon
										>
										<div
											class="flex-grow-1 text-caption text-center"
											style="line-height: 1; height: 24px"
										>
											Pekerjaan Umum
										</div>
									</div>
								</v-card>
							</v-item>
						</v-col>

						<v-col>
							<v-item v-slot="{ selectedClass, toggle }">
								<v-card
									:class="[
										'd-flex flex-column justify-center align-center',
										selectedClass,
									]"
									height="100"
									dark
									@click="toggle"
								>
									<div class="text-center">
										<v-icon class="mb-2" size="x-large"
											>cottage</v-icon
										>
										<div
											class="flex-grow-1 text-caption text-center"
											style="line-height: 1; height: 24px"
										>
											Perumahan Rakyat
										</div>
									</div>
								</v-card>
							</v-item>
						</v-col>

						<v-col>
							<v-item v-slot="{ selectedClass, toggle }">
								<v-card
									:class="[
										'd-flex flex-column justify-center align-center',
										selectedClass,
									]"
									height="100"
									dark
									@click="toggle"
								>
									<div class="text-center">
										<v-icon class="mb-2" size="x-large"
											>local_police</v-icon
										>
										<div
											class="flex-grow-1 text-caption text-center"
											style="line-height: 1; height: 24px"
										>
											Trantibum Linmas
										</div>
									</div>
								</v-card>
							</v-item>
						</v-col>

						<v-col>
							<v-item v-slot="{ selectedClass, toggle }">
								<v-card
									:class="[
										'd-flex flex-column justify-center align-center',
										selectedClass,
									]"
									height="100"
									dark
									@click="toggle"
								>
									<div class="text-center">
										<v-icon class="mb-2" size="x-large"
											>compost</v-icon
										>
										<div
											class="flex-grow-1 text-caption text-center"
											style="line-height: 1; height: 24px"
										>
											Sosial
										</div>
									</div>
								</v-card>
							</v-item>
						</v-col>
					</v-row>
				</v-item-group>

				<div class="text-overline mt-4">JENIS PENGADUAN</div>
				<v-row dense>
					<v-col cols="12">
						<v-select
							label="Pendidikan Anak Usia Dini"
							v-model="record.kind"
							hide-details
						></v-select>
					</v-col>
				</v-row>

				<div class="text-overline mt-4">DATA PELAPOR</div>
				<v-row dense>
					<v-col cols="6">
						<v-text-field
							label="Nomor KTP"
							v-model="record.nik"
							hide-details
						></v-text-field>
					</v-col>

					<v-col cols="6">
						<v-text-field
							label="Nama Lengkap"
							v-model="record.name"
							hide-details
						></v-text-field>
					</v-col>

					<v-col cols="12">
						<v-textarea
							label="Keluhan"
							v-model="record.complaint"
							hide-details
						></v-textarea>
					</v-col>
				</v-row>
			</v-card-text>
		</template>

		<template v-slot:helpdesk></template>
	</form-show>
</template>

<script>
export default {
	name: "posyandu-activity-show",
};
</script>
