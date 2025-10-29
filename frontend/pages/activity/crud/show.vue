<template>
	<form-show with-helpdesk>
		<template v-slot:default="{ combos: { services }, record }">
			<v-sheet>
				<v-card-text>
					<v-row dense>
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
							<v-currency-field
								autocomplete="off"
								label="Jumlah Kebutuhan Anggaran"
								v-model="record.budget"
								hide-details
								readonly
							></v-currency-field>
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
							<v-text-field
								autocomplete="off"
								label="Pelaksana"
								v-model="record.executor"
								hide-details
								readonly
							></v-text-field>
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

				<div class="text-overline px-4">Daftar Pengaduan</div>

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

		<template v-slot:helpdesk></template>
	</form-show>
</template>

<script>
export default {
	name: "posyandu-activity-show",
};
</script>
