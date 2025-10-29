<template>
	<form-show hide-edit hide-delete with-helpdesk>
		<template v-slot:default="{ combos: { services }, record }">
			<v-sheet class="position-relative">
				<v-chip
					class="position-absolute"
					color="cyan"
					size="small"
					label
					style="top: -24px; right: 16px"
				>
					<v-icon icon="diamond_shine" start></v-icon>
					{{ record.status }}
				</v-chip>

				<v-card-text>
					<v-row dense>
						<v-col cols="12">
							<v-text-field
								autocomplete="off"
								label="Lembaga"
								v-model="record.community_name"
								hide-details
								readonly
							></v-text-field>
						</v-col>

						<v-col cols="12">
							<v-text-field
								autocomplete="off"
								label="Desa"
								v-model="record.village_name"
								hide-details
								readonly
							></v-text-field>
						</v-col>

						<v-col cols="12">
							<v-text-field
								autocomplete="off"
								label="Nama Kegiatan"
								v-model="record.name"
								hide-details
								readonly
							></v-text-field>
						</v-col>

						<v-col cols="6">
							<v-select
								:items="services"
								autocomplete="off"
								label="Bidang"
								v-model="record.service_id"
								hide-details
								readonly
							></v-select>
						</v-col>

						<v-col cols="6">
							<v-date-input
								autocomplete="off"
								prepend-icon=""
								label="Tanggal"
								v-model="record.date"
								hide-details
								readonly
							></v-date-input>
						</v-col>

						<v-col cols="6">
							<v-text-field
								autocomplete="off"
								label="Pelaksana"
								v-model="record.executor"
								hide-details
								readonly
							></v-text-field>
						</v-col>

						<v-col cols="6">
							<v-currency-field
								autocomplete="off"
								label="Jumlah Penerima Manfaat"
								v-model="record.participants"
								hide-details
								readonly
							></v-currency-field>
						</v-col>

						<v-col cols="12">
							<v-textarea
								autocomplete="off"
								label="Keterangan"
								v-model="record.description"
								hide-details
								readonly
							></v-textarea>
						</v-col>
					</v-row>
				</v-card-text>

				<div class="text-overline px-4 mt-4">Informasi Pendanaan</div>
				<v-card-text class="pt-0">
					<v-row dense>
						<v-col cols="12">
							<v-select
								:items="[
									{ title: 'APBDES', value: 'APBDES' },
									{ title: 'APBD_KOTAKAB', value: 'APBD_DISTRICT' },
									{ title: 'APBD_PROVINSI', value: 'APBD_PROVINCE' },
									{ title: 'APBN', value: 'APBN' },
									{ title: 'CSR', value: 'CSR' },
									{ title: 'KOMUNITAS', value: 'COMMUNITY' },
									{ title: 'LAIN_LAIN', value: 'OTHER' },
								]"
								autocomplete="off"
								label="Sumber Dana"
								v-model="record.source"
								hide-details
								readonly
							></v-select>
						</v-col>

						<v-col cols="6">
							<v-currency-field
								autocomplete="off"
								label="Jumlah Kebutuhan"
								v-model="record.budget"
								hide-details
								readonly
							></v-currency-field>
						</v-col>

						<v-col cols="6">
							<v-currency-field
								autocomplete="off"
								label="Jumlah Realisasi"
								v-model="record.realized"
								hide-details
								readonly
							></v-currency-field>
						</v-col>

						<v-col cols="12">
							<v-textarea
								autocomplete="off"
								label="Keterangan"
								v-model="record.notes"
								hide-details
								readonly
							></v-textarea>
						</v-col>
					</v-row>
				</v-card-text>

				<div class="text-overline px-4 mt-4">Daftar Pengaduan</div>

				<v-table density="compact">
					<thead>
						<tr>
							<th class="text-left">Nama</th>
							<th class="text-left">Keterangan</th>
						</tr>
					</thead>

					<tbody>
						<tr v-for="(complaint, index) in record.complaints" :key="index">
							<td>{{ complaint.name }}</td>
							<td>{{ complaint.description }}</td>
						</tr>
					</tbody>
				</v-table>
			</v-sheet>
		</template>

		<template
			v-slot:info="{
				combos: { workunits },
				statuses: {
					hasBeenDeterminated,
					hasBeenRejected,
					isAdminDesa,
					isAdminPosyandu,
				},
				record,
				theme,
			}"
		>
			<div class="text-overline mt-4">Link</div>
			<v-divider class="mb-3"></v-divider>

			<v-row dense>
				<v-col cols="6">
					<v-btn
						:color="theme"
						variant="flat"
						size="large"
						block
						@click="$router.push({ name: 'posyandu-premise' })"
					>
						<div class="text-caption text-uppercase" style="line-height: 1.2">
							Daftar<br />
							Pengaduan
						</div>
					</v-btn>
				</v-col>

				<v-col cols="6">
					<v-btn
						:color="theme"
						variant="flat"
						size="large"
						block
						@click="$router.push({ name: 'posyandu-recipient' })"
					>
						<div class="text-caption text-uppercase" style="line-height: 1.2">
							Penerima<br />
							Manfaat
						</div>
					</v-btn>
				</v-col>

				<v-col cols="6" v-if="isAdminDesa && record.status === 'POSTED'">
					<v-btn color="green" variant="flat" size="large" block>
						<div class="text-caption text-uppercase" style="line-height: 1.2">
							Verifikasi<br />
							dan Setujui
						</div>

						<v-dialog activator="parent" max-width="560">
							<template v-slot:default="{ isActive }">
								<v-card prepend-icon="home" title="Sumber Dana Kegiatan">
									<v-card-text>
										<v-row dense>
											<v-col cols="12">
												<v-select
													:items="[
														{
															title: 'APBDES',
															value: 'APBDES',
														},
														{
															title: 'CSR',
															value: 'CSR',
														},
														{
															title: 'KOMUNITAS',
															value: 'COMMUNITY',
														},
														{
															title: 'LAIN-LAIN',
															value: 'OTHER',
														},
													]"
													autocomplete="off"
													label="Sumber Dana"
													v-model="record.source"
													hide-details
												></v-select>
											</v-col>

											<v-col cols="6">
												<v-currency-field
													autocomplete="off"
													label="Jumlah Kebutuhan"
													v-model="record.budget"
													hide-details
													readonly
												></v-currency-field>
											</v-col>

											<v-col cols="6">
												<v-currency-field
													autocomplete="off"
													label="Jumlah Realisasi"
													v-model="record.realized"
													hide-details
												></v-currency-field>
											</v-col>

											<v-col cols="12">
												<v-textarea
													autocomplete="off"
													label="Catatan Hasil Pemeriksaan"
													v-model="record.notes"
													hide-details
												></v-textarea>
											</v-col>
										</v-row>
									</v-card-text>

									<template v-slot:actions>
										<v-btn
											class="ml-auto"
											color="green"
											text="Verifikasi dan Setujui"
											@click="postDeterminated(record)"
										></v-btn>

										<v-btn
											class="ml-1"
											color="grey"
											text="Tutup"
											@click="isActive.value = false"
										></v-btn>
									</template>
								</v-card>
							</template>
						</v-dialog>
					</v-btn>
				</v-col>

				<v-col cols="6" v-if="isAdminDesa && record.status === 'POSTED'">
					<v-btn color="green" variant="flat" size="large" block>
						<div class="text-caption text-uppercase" style="line-height: 1.2">
							Verifikasi<br />
							Dan Teruskan
						</div>

						<v-dialog activator="parent" max-width="560">
							<template v-slot:default="{ isActive }">
								<v-card prepend-icon="home" title="Verifikasi Kegiatan">
									<v-card-text>
										<v-row dense>
											<v-col cols="12">
												<v-textarea
													autocomplete="off"
													label="Catatan Hasil Pemeriksaan"
													v-model="record.notes"
													hide-details
												></v-textarea>
											</v-col>
										</v-row>
									</v-card-text>

									<template v-slot:actions>
										<v-btn
											class="ml-auto"
											color="green"
											text="Verifikasi dan Setujui"
											@click="postVerified(record)"
										></v-btn>

										<v-btn
											class="ml-1"
											color="grey"
											text="Tutup"
											@click="isActive.value = false"
										></v-btn>
									</template>
								</v-card>
							</template>
						</v-dialog>
					</v-btn>
				</v-col>

				<v-col cols="12" v-if="isAdminDesa && record.status === 'POSTED'">
					<v-btn color="orange" variant="flat" size="large" block>
						<div
							class="text-caption text-uppercase text-white"
							style="line-height: 1.2"
						>
							Tolak<br />
							Dan Kembalikan
						</div>

						<v-dialog activator="parent" max-width="560">
							<template v-slot:default="{ isActive }">
								<v-card prepend-icon="home" title="Tolak Kegiatan">
									<v-card-text>
										<v-row dense>
											<v-col cols="12">
												<v-textarea
													autocomplete="off"
													label="Catatan Hasil Pemeriksaan"
													v-model="record.notes"
													hide-details
												></v-textarea>
											</v-col>
										</v-row>
									</v-card-text>

									<template v-slot:actions>
										<v-btn
											class="ml-auto"
											color="green"
											text="Tolak dan Kembalikan"
											@click="postRejected(record)"
										></v-btn>

										<v-btn
											class="ml-1"
											color="grey"
											text="Tutup"
											@click="isActive.value = false"
										></v-btn>
									</template>
								</v-card>
							</template>
						</v-dialog>
					</v-btn>
				</v-col>

				<v-col cols="6" v-if="isAdminPosyandu && record.status === 'VERIFIED'">
					<v-btn color="green" variant="flat" size="large" block>
						<div
							:disabled="hasBeenDeterminated"
							class="text-caption text-uppercase"
							style="line-height: 1.2"
						>
							Verifikasi<br />
							Dan Teruskan
						</div>

						<v-dialog activator="parent" max-width="560">
							<template v-slot:default="{ isActive }">
								<v-card prepend-icon="home" title="Tolak Kegiatan">
									<v-card-text>
										<v-row dense>
											<v-col cols="12">
												<v-combobox
													:items="workunits"
													:return-object="false"
													autocomplete="off"
													label="Unit Kerja"
													v-model="record.workunit_id"
													hide-details
												></v-combobox>
											</v-col>
										</v-row>
									</v-card-text>

									<template v-slot:actions>
										<v-btn
											class="ml-auto"
											color="green"
											text="Verifikasi dan Teruskan"
											@click="postSubmitted(record)"
										></v-btn>

										<v-btn
											class="ml-1"
											color="grey"
											text="Tutup"
											@click="isActive.value = false"
										></v-btn>
									</template>
								</v-card>
							</template>
						</v-dialog>
					</v-btn>
				</v-col>

				<v-col cols="6" v-if="isAdminPosyandu && record.status === 'VERIFIED'">
					<v-btn
						:disabled="!hasBeenDeterminated && hasBeenRejected"
						color="deep-orange"
						variant="flat"
						size="large"
						block
					>
						<div class="text-caption text-uppercase" style="line-height: 1.2">
							Tolak<br />
							Dan Kembalikan
						</div>

						<v-dialog activator="parent" max-width="560">
							<template v-slot:default="{ isActive }">
								<v-card prepend-icon="home" title="Tolak Kegiatan">
									<v-card-text>
										<v-row dense>
											<v-col cols="12">
												<v-textarea
													autocomplete="off"
													label="Catatan Pemeriksaan"
													v-model="record.notes"
													hide-details
												></v-textarea>
											</v-col>
										</v-row>
									</v-card-text>

									<template v-slot:actions>
										<v-btn
											class="ml-auto"
											color="green"
											text="Tolak dan Kembalikan"
											@click="postRejected(record)"
										></v-btn>

										<v-btn
											class="ml-1"
											color="grey"
											text="Tutup"
											@click="isActive.value = false"
										></v-btn>
									</template>
								</v-card>
							</template>
						</v-dialog>
					</v-btn>
				</v-col>
			</v-row>
		</template>
	</form-show>
</template>

<script>
export default {
	name: "posyandu-activity-show",

	methods: {
		postDeterminated: function (record) {
			this.$http(`posyandu/api/activity/${record.id}/determinated`, {
				method: "POST",
				params: record,
			}).then(() => {
				this.$router.push({ name: "posyandu-activity" });
			});
		},

		postRejected: function (record) {
			this.$http(`posyandu/api/activity/${record.id}/rejected`, {
				method: "POST",
				params: record,
			}).then(() => {
				this.$router.push({ name: "posyandu-activity" });
			});
		},

		postSubmitted: function (record) {
			this.$http(`posyandu/api/activity/${record.id}/submitted`, {
				method: "POST",
				params: record,
			}).then(() => {
				this.$router.push({ name: "posyandu-activity" });
			});
		},

		postVerified: function (record) {
			this.$http(`posyandu/api/activity/${record.id}/verified`, {
				method: "POST",
				params: record,
			}).then(() => {
				this.$router.push({ name: "posyandu-activity" });
			});
		},
	},
};
</script>
